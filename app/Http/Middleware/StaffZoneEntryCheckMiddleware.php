<?php
/*
 * SPDX-FileCopyrightText: 2024 Kuropen <hy-kuropen@eternie-labs.net>
 * SPDX-License-Identifier: LicenseRef-KUROPEN-ORG-PUBLIC-CODE
 */

namespace App\Http\Middleware;

use App\Http\Controllers\StaffZoneController;
use App\Services\ExternalApi\Misskey\MisskeyUserApi;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
        // SummalyBot は Misskey 用のOGPクローラーのため、問い合わせ詳細ページへのアクセスに対しては専用のビューを返す
        if (
            str_contains($request->header('User-Agent'), 'SummalyBot')
            && $request->routeIs('staff.inquiry.show')
        ) {
            return response()->view('staff.inquiry.for_ogp_crawler');
        }

        // アクセストークンがセッションに保存されているか確認
        if (blank($token = $request->cookie(config('const.staff_zone.access_token_key')))) {
            $url = $request->fullUrl();

            // $urlのドメイン名がアプリの設定と異なる場合は例外を投げる
            abort_unless(
                compare_url(
                    $url,
                    config('app.url')
                ),
                421,
                'Misdirected request. Maybe wrong configuration about Application URL.'
            );

            return redirect()->action(
                [StaffZoneController::class, 'index'],
                ['landing' => $url],
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
