<?php

namespace App\Services\ExternalApi\Misskey;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Ramsey\Uuid\UuidInterface;

/**
 * MiAuthでアクセストークンを取得する処理を提供します。
 * @package App\Services\ExternalApi\Misskey
 * @see https://misskey-hub.net/ja/docs/for-developers/api/token/miauth/
 */
class MiAuth
{
    /**
     * MiAuthの認証リクエストURLを取得します。
     * @param UuidInterface $sessionUuid
     * @param string $callbackTo
     * @param array $permission
     * @return string
     */
    public function getAuthRequestUrl(UuidInterface $sessionUuid, string $callbackTo, array $permission): string
    {
        $appName = config('app.name');
        $baseUrl = config('const.misskey.host') . "/miauth/{$sessionUuid->toString()}";
        $urlParameters = [
            'name' => $appName,
            'callback' => url($callbackTo),
            'permission' => implode(',', $permission),
        ];
        return $baseUrl . '?' . http_build_query($urlParameters);
    }

    public function getAccessToken(UuidInterface|string $sessionUuid): string
    {
        if ($sessionUuid instanceof UuidInterface) {
            $sessionUuid = $sessionUuid->toString();
        }
        $request = Http::post(config('const.misskey.host') . "/api/miauth/{$sessionUuid}/check");
        abort_if($request->failed(), 500, 'MiAuthの認証に失敗しました。');
        $accessTokenInfo = $request->json();
        $isOk = $accessTokenInfo['ok'];
        abort_if(!$isOk, 500, 'MiAuthの認証に失敗しました。');
        return $accessTokenInfo['token'];
    }
}
