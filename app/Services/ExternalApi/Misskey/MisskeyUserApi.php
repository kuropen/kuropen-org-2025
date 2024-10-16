<?php

namespace App\Services\ExternalApi\Misskey;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Misskeyのユーザー情報を取得する処理を提供します。
 */
class MisskeyUserApi extends MisskeyApiCommunicator
{
    public function getUserInfo(string $accessToken)
    {
        return $this->request('/api/i', $accessToken);
    }

    /**
     * ユーザーが管理者またはモデレーター権限を持っているかどうかを判定します。
     * @param string|array $arg アクセストークンまたはユーザー情報（アクセストークンが指定された場合、APIを呼び出してユーザー情報を取得します）
     * @param bool $adminOnly 管理者権限のみを対象とするかどうか
     * @return bool
     */
    public function hasPrivilege(string|array $arg, bool $adminOnly = false): bool
    {
        $userInfo = is_string($arg) ? $this->getUserInfo($arg) : $arg;
        return $userInfo['isAdmin'] || (!$adminOnly && $userInfo['isModerator']);
    }
}
