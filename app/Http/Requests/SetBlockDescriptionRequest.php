<?php

namespace App\Http\Requests;

use App\Models\BlockedFediverseServer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SetBlockDescriptionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'serverId' => ['required',
                'integer',
                Rule::in(BlockedFediverseServer::idsNotRepealed())],
            'description' => ['required', 'string', 'max:50'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'serverId.required' => 'サーバーIDは必須です。',
            'serverId.integer' => 'サーバーIDは整数でなければなりません。',
            'serverId.in' => '指定されたサーバーは登録されていないか、ブロック解除されています。',
            'description.required' => '説明は必須です。',
            'description.string' => '説明は文字列でなければなりません。',
            'description.max' => '説明は50文字以内でなければなりません。',
        ];
    }
}
