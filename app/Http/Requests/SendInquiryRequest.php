<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class SendInquiryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
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

    public function authorize(): bool
    {
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
            'type' => 'required',
            'message' => 'required',
        ];
    }
}
