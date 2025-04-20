<?php

namespace App\Http\Requests;

use App\Models\Document;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DocumentListApiRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'source_category' => [
                'sometimes',
                'string',
                Rule::in(array_keys(config('const.dataSources'))),
            ],
            'limit' => [
                'required',
                'integer',
                'min:1',
                'max:100',
            ],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
