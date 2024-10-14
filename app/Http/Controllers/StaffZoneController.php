<?php

namespace App\Http\Controllers;

use App\Http\Requests\StaffAuthCallbackRequest;
use App\Http\Requests\StaffAuthRequest;
use App\Models\InquiryRecord;
use App\Services\ExternalApi\Misskey\MiAuth;
use App\Services\ExternalApi\Misskey\MisskeyUserApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Ramsey\Uuid\Uuid;

class StaffZoneController
{
    public function index(StaffAuthRequest $request, MiAuth $miAuth)
    {
        $landingUrl = $request->input('landing') ?: action([self::class, 'menu']);

        // アクセストークンがあればリダイレクト
        if (Cookie::has(config('const.staff_zone.access_token_key'))) {
            return redirect($landingUrl);
        }

        // Landing URLをセッションに保存
        $request->session()->put(config('const.staff_zone.landing_url_key'), $landingUrl);

        // UUIDを生成してMiAuthの認証リクエストURLにリダイレクトする
        $sessionUuid = Uuid::uuid4();
        $callbackTo = action([self::class, 'authCallback']);
        $permission = ['read:account'];
        return redirect($miAuth->getAuthRequestUrl($sessionUuid, $callbackTo, $permission));
    }

    public function authCallback(StaffAuthCallbackRequest $request, MiAuth $miAuth, MisskeyUserApi $userApi)
    {
        $sessionUuid = $request->input('session');

        // MiAuthからアクセストークンを取得する
        $token = $miAuth->getAccessToken($sessionUuid);

        // 権限判定
        if (!$userApi->hasPrivilege($token)) {
            return response()->view('staff.privilege_error', [], 403);
        }

        // アクセストークンをCookieに保存する
        $tokenCookie = Cookie::forever(config('const.staff_zone.access_token_key'), $token);

        // リダイレクト
        $landingUrl =
            $request->session()->pull(config('const.staff_zone.landing_url_key'))
            ?? action([self::class, 'menu']);
        return redirect($landingUrl)->withCookie($tokenCookie);
    }

    public function menu(Request $request)
    {
        // セッション変数からユーザー情報を取り出す
        $userInfo = $request->session()->get(config('const.staff_zone.current_user_info_key'));
        $userName = $userInfo['name'];
        $isAdmin = $userInfo['isAdmin'];
        $isModerator = $userInfo['isModerator'];

        $privilege = $isAdmin ? '管理者' : ($isModerator ? 'モデレーター' : '一般ユーザー');

        return view(
            'staff.menu',
            compact(
                'userName',
                'privilege'
            )
        );
    }

    public function logout()
    {
        $cookieRemove = Cookie::forget(config('const.staff_zone.access_token_key'));
        return redirect('/')->withCookie($cookieRemove);
    }

    public function showInquiry(string $slug)
    {
        $inquiry = InquiryRecord::where('slug', $slug)->firstOrFail();

        // 問い合わせ種別を確認: Misskey関連でない場合は管理者のみ閲覧可
        if (!$inquiry->type->misskey_related) {
            $userInfo = request()->session()->get(config('const.staff_zone.current_user_info_key'));
            if (!$userInfo['isAdmin']) {
                abort(403, 'この問い合わせはMisskey関連ではないため、モデレーターは閲覧できません。');
            }
        }

        return view('staff.inquiry.detail', compact('inquiry'));
    }
}
