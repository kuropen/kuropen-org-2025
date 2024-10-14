<?php

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
        return [
            'name' => 'required',
            'email' => 'required|email',
            'type' => [
                'required_without:type_id',
                'prohibits:type_id',
                'string',
                Rule::in(InquiryType::getAvailableNames()),
            ],
            'type_id' => [
                'prohibits:type',
                'required_without:type',
                'integer',
                Rule::in(InquiryType::getAvailableIds()),
            ],
            'message' => 'required',
        ];
    }
}
