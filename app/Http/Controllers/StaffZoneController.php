<?php

namespace App\Http\Controllers;

use App\Http\Requests\StaffAuthCallbackRequest;
use App\Services\ExternalApi\Misskey\MiAuth;
use App\Services\ExternalApi\Misskey\MisskeyUserApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Ramsey\Uuid\Uuid;

class StaffZoneController
{
    public function index(MiAuth $miAuth)
    {
        // アクセストークンがあればメニュー画面へリダイレクト
        if (Cookie::has(config('const.staff_zone.access_token_key'))) {
            return redirect(action([self::class, 'menu']));
        }

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

        // アクセストークンを用いてユーザー情報を取得する
        $userInfo = $userApi->getUserInfo($token);
        $isAdmin = $userInfo['isAdmin'];
        $isModerator = $userInfo['isModerator'];
        abort_unless($isAdmin || $isModerator, 403, '権限がありません。');

        // アクセストークンをCookieに保存する。Cookieの有効期限は1年間とする。
        Cookie::forever(config('const.staff_zone.access_token_key'), $token);

        // メニュー画面へリダイレクト
        return redirect(action([self::class, 'menu']));
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
        Cookie::forget(config('const.staff_zone.access_token_key'));
        return redirect('/');
    }
}
