<?php
/*
 * SPDX-FileCopyrightText: 2024 Kuropen <hy-kuropen@eternie-labs.net>
 * SPDX-License-Identifier: LicenseRef-KUROPEN-ORG-PUBLIC-CODE
 */

namespace App\Http\Requests;

use App\Models\InquiryType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class SendInquiryRequest extends FormRequest
{
    /**
     * Get the authorization header for the request and split it into timestamp and token.
     * @return array|null
     */
    public function extractToken(): ?array
    {
        $authorization = $this->header('Authorization');
        if (empty($authorization)) {
            Log::warning('Authorization header is empty');
            return null;
        }

        $authorization = str_replace('Basic ', '', $authorization);
        $authorization = base64_decode($authorization);
        Log::debug(var_export($authorization, true));
        return explode(':', $authorization);
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // JSON APIでなければ以下の処理は行わない
        if (!$this->expectsJson()) {
            return true;
        }

        // BASIC認証のAuthorizationヘッダから情報を取り出す
        list($timestamp, $token) = $this->extractToken();

        // キャッシュからトークンを取得
        $cachedToken = Cache::get("token_{$timestamp}");
        // キャッシュにトークンが存在しない、またはトークンが一致しない場合はエラー
        if ($cachedToken === null || $cachedToken !== $token) {
            return false;
        }
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $invitationTypeId = InquiryType::where('invitation', true)->first()->id;
        return [
            'name' => 'required',
            'email' => 'required|email',
            'type' => [
                'prohibited'
            ],
            'type_id' => [
                'required',
                'integer',
                Rule::in(InquiryType::getAvailableIds()),
            ],
            'message' => 'required',
            'terms_agree' => [
                'required_if:type_id,' . $invitationTypeId,
                'accepted_if:type_id,' . $invitationTypeId,
            ],
            'g-recaptcha-response' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        // 定義されている各バリデーションルールのエラーメッセージを日本語で定義
        return [
            'name.required' => '名前は必須です。',
            'email.required' => 'メールアドレスは必須です。',
            'email.email' => 'メールアドレスの形式が正しくありません。',
            'type.required_without' => '問い合わせ種別は必須です。',
            'type.prohibits' => '問い合わせ種別は不正です。',
            'type.string' => '問い合わせ種別は文字列で指定してください。',
            'type.in' => '問い合わせ種別が不正です。',
            'type_id.required_without' => '問い合わせ種別は必須です。',
            'type_id.prohibits' => '問い合わせ種別は不正です。',
            'type_id.integer' => '問い合わせ種別が不正です。',
            'type_id.in' => '問い合わせ種別が不正です。',
            'message.required' => '問い合わせ内容は必須です。',
            'terms_agree.required_if' => '利用規約・注意事項に同意する場合はチェックしてください。',
            'terms_agree.accepted_if' => '利用規約・注意事項に同意する場合はチェックしてください。',
            'g-recaptcha-response.required' => 'CAPTCHAの検証に失敗しました。',
        ];
    }
}
