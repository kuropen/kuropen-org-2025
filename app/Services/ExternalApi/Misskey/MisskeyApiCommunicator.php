<?php
/*
 * SPDX-FileCopyrightText: 2024 Kuropen <hy-kuropen@eternie-labs.net>
 * SPDX-License-Identifier: BSL-1.0
 */

namespace App\Services\ExternalApi\Misskey;

use App\Exceptions\MisskeyApiException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class MisskeyApiCommunicator
{
    /**
     * Misskey APIにリクエストを送信します。
     * @param string $endpoint
     * @param string|null $accessToken
     * @param array $params
     * @return array|mixed
     */
    public function request(string $endpoint, ?string $accessToken = null, array $params = [])
    {
        $request = Http::withBody(filled($params) ? json_encode($params) : '{}');
        if (filled($accessToken)) {
            $request = $request->withToken($accessToken);
        }
        try {
            return $request->post(config('const.misskey.host') . $endpoint)
                ->throw()->json();
        } catch (RequestException $e) {
            throw new MisskeyApiException($e->response->json('error.message'), $e->response->status(), $e);
        }
    }
}
