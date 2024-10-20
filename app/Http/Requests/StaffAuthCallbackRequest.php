<?php
/*
 * SPDX-FileCopyrightText: 2024 Kuropen <hy-kuropen@eternie-labs.net>
 * SPDX-License-Identifier: LicenseRef-KUROPEN-ORG-PUBLIC-CODE
 */

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StaffAuthCallbackRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'session' => 'required|uuid',
        ];
    }

    public function failedValidation(Validator $validator): never
    {
        // Session UUIDを正しく送ってこなかったコールバック要求に対して
        // 元のページにリダイレクトさせる必要性は薄いので、
        // 424 Failed Dependencyを返して終了
        abort(424, 'Invalid session ID');
    }
}
