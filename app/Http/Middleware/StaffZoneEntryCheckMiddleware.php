<?php

namespace App\Http\Middleware;

use App\Http\Controllers\StaffZoneController;
use App\Services\ExternalApi\Misskey\MisskeyUserApi;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StaffZoneEntryCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // アクセストークンがセッションに保存されているか確認
        if (!($token = $request->cookie(config('const.staff_zone.access_token_key')))) {
            return redirect()->action([StaffZoneController::class, 'index']);
        }

        $userApi = new MisskeyUserApi();
        $userInfo = $userApi->getUserInfo($token);
        abort_unless($userInfo['isAdmin'] || $userInfo['isModerator'], 403, '権限がありません。');

        // $userInfo から name, isAdmin, isModerator の各要素を取り出し、セッション変数に格納する
        $request->session()->put(config('const.staff_zone.current_user_info_key'), $userInfo);

        return $next($request);
    }
}
