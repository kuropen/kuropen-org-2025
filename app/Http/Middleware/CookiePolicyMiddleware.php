<?php

namespace App\Http\Middleware;

use App\Services\CookiePolicyService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class CookiePolicyMiddleware
{
    public function __construct(private readonly CookiePolicyService $cookiePolicyService)
    {
        // constructor
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // プライバシーポリシーファイル（/resources/md/legal.md）の最終更新日時を取得
        $lastModified = $this->cookiePolicyService->getLastDocumentUpdatedTime();

        // Cookieからプライバシーポリシーの最終同意日時を取得
        $cookiePolicyConfirmation = $request->cookie(config('const.cookie_policy_confirmation_key'));

        // プライバシーポリシーの最終同意日時がCookieに保存されていない、または
        // プライバシーポリシーファイルが更新されている場合は、
        // プライバシーポリシーに関する確認メッセージを表示するフラグをビュー変数にセット
        View::share(
            'cookiePolicyConfirmationRequired',
            $cookiePolicyConfirmation === null || $cookiePolicyConfirmation < $lastModified
        );
        View::share(
            'cookiePolicyLastModified',
            $lastModified
        );

        return $next($request);
    }
}
