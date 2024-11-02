<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanetDeleteRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'url' => 'required|url|exists:documents,url',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function messages()
    {
        return [
            'url.required' => 'URLを入力してください。',
            'url.url' => 'URLの形式が正しくありません。',
            'url.exists' => '指定されたURLは存在しません。',
        ];
    }
}
