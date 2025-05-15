<?php
/*
 * SPDX-FileCopyrightText: 2024 Kuropen <webmaster@kuropen.org>
 * SPDX-License-Identifier: LicenseRef-KUROPEN-ORG-PUBLIC-CODE
 */

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StaffAuthRequest extends FormRequest
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
            // landingパラメータを指定する場合はこのサーバーのドメイン名のURLであることを要求する
            'landing' => [
                'sometimes',
                'url',
                'regex:/^' . preg_quote(config('app.url'), '/') . '/'
            ],
        ];
    }

    public function failedValidation(Validator $validator): never
    {
        // オープンリダイレクト防止のためのバリデーションなので、
        // 失敗した場合は 421 Misdirected Request を返して終了
        abort(421, 'Misdirected request.');
    }
}
