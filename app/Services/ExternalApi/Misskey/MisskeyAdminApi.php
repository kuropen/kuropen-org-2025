<?php

namespace App\Services\ExternalApi\Misskey;

use Illuminate\Support\Facades\Http;

/**
 * Misskeyの管理者APIを提供します。
 */
class MisskeyAdminApi extends MisskeyApiCommunicator
{
    /**
     * メタデータを取得します。
     * @param string $accessToken
     * @return MisskeyAdminMetadata
     */
    public function getMetadata(string $accessToken): MisskeyAdminMetadata
    {
        return new MisskeyAdminMetadata($accessToken);
    }

    /**
     * ユーザー情報を取得します。
     * @param string $accessToken
     * @param array{
     *     limit?: int,
     *     offset?: int,
     *     sort?: string,
     *     state?: string,
     *     origin?: string,
     *     username?: string,
     *     hostname?: string,
     * } $params
     * @return array
     */
    public function getUsers(string $accessToken, array $params): array
    {
        return $this->request('/api/admin/show-users', $accessToken, $params);
    }
}
