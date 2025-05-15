<?php
/*
 * SPDX-FileCopyrightText: 2024 Kuropen <webmaster@kuropen.org>
 * SPDX-License-Identifier: BSL-1.0
 */

namespace App\Services\ExternalApi\Misskey;

use Illuminate\Support\Facades\Http;
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
     * @param string|null $callbackTo
     * @param array $permission
     * @param string $appNameSuffix
     * @return string
     */
    public function getAuthRequestUrl(
        UuidInterface $sessionUuid,
        ?string $callbackTo,
        array $permission,
        string $appNameSuffix = ''
    ): string
    {
        $appName = config('app.name') . $appNameSuffix;
        $baseUrl = config('const.misskey.host') . "/miauth/{$sessionUuid->toString()}";
        $urlParameters = [
            'name' => $appName,
            'permission' => implode(',', $permission),
        ];
        if (filled($callbackTo)) {
            $urlParameters['callback'] = url($callbackTo);
        }
        return $baseUrl . '?' . http_build_query($urlParameters);
    }

    /**
     * MiAuthの認証に成功した場合、アクセストークンを取得します。
     * @param UuidInterface|string $sessionUuid
     * @return string
     */
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
