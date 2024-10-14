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
            return redirect()->action(
                [StaffZoneController::class, 'index'],
                ['landing' => $request->fullUrl()],
            );
        }

        $userApi = new MisskeyUserApi();
        $userInfo = $userApi->getUserInfo($token);
        if (!$userApi->hasPrivilege($userInfo)) {
            return response()->view('staff.privilege_error', [], 403);
        }

        // $userInfo をセッション変数に格納する
        $request->session()->put(config('const.staff_zone.current_user_info_key'), $userInfo);

        return $next($request);
    }
}
