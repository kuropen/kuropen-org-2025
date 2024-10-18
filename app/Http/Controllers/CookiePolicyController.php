<?php

namespace App\Http\Controllers;

use App\Http\Requests\CookiePolicyConfirmRequest;
use App\Services\CookiePolicyService;
use Illuminate\Http\Request;

class CookiePolicyController extends Controller
{
    public function confirm(CookiePolicyService $cookiePolicyService, CookiePolicyConfirmRequest $request): \Illuminate\Http\Response
    {
        // 確認時間を受け取る。
        // ただしJavaScriptのDate.now()の値すなわちミリ秒単位のため、秒単位に変換する
        // 例: 1634024400000 -> 1634024400
        $time = (int)($request->input('time') / 1000);

        // CookiePolicyServiceを使って、Cookieを作成
        $cookie = $cookiePolicyService->makeConfirmationCookie($time);

        // Cookie付きで 204 No Content を返す
        return response()->noContent()->withCookie($cookie);
    }
}
