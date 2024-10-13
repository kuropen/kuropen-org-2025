<?php

namespace App\Services\ExternalApi\Misskey;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Misskeyのユーザー情報を取得する処理を提供します。
 */
class MisskeyUserApi
{
    public function getUserInfo(string $accessToken)
    {
        $request = Http::withToken($accessToken)
            ->withBody('{}')
            ->post(config('const.misskey.host') . '/api/i');
        $response = $request->json();
        abort_if($request->failed(), 500, 'Misskeyのユーザー情報の取得に失敗しました。');
        return $response;
    }
}
