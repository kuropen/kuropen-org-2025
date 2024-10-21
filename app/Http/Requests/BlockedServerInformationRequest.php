<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlockedServerInformationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'repealed' => 'sometimes|bool',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
