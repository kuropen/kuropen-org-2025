<?php
/*
 * SPDX-FileCopyrightText: 2024 Kuropen <hy-kuropen@eternie-labs.net>
 * SPDX-License-Identifier: LicenseRef-KUROPEN-ORG-PUBLIC-CODE
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;

class MisskeyBatchToken extends Model
{
    use SoftDeletes;
    protected $fillable = ['token', 'is_admin', 'for_user', 'permission'];

    /**
     * トークンを保存します。
     * データに含まれるトークンは暗号化されます。
     * 管理者フラグまたは対象フラグが同じトークンがすでに存在する場合、それを削除します。
     * @param array $tokenData
     * @return MisskeyBatchToken
     */
    public static function storeToken(array $tokenData): MisskeyBatchToken
    {
        // 同じ条件で作成されたトークンのデータがすでにあれば、それを削除する。
        // 条件とは、 is_admin が true であるか、そうでなければ for_user が同じであること。
        self::where('is_admin', $tokenData['is_admin'])
            ->orWhere('for_user', $tokenData['for_user'])
            ->each(function ($token) {
                // トークンの削除はinfoログに記録する
                Log::info('MisskeyBatchToken: Token deleted', $token->toArray());
                $token->delete();
            });

        $tokenData['token'] = encrypt($tokenData['token']);

        return self::create($tokenData);
    }

    /**
     * トークンを復号して取得します。
     * @return string
     */
    public function getDecryptedToken(): string
    {
        return decrypt($this->token);
    }
}
