<?php
/*
 * SPDX-FileCopyrightText: 2024 Kuropen <hy-kuropen@eternie-labs.net>
 * SPDX-License-Identifier: LicenseRef-KUROPEN-ORG-PUBLIC-CODE
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlockedFediverseServer extends Model
{
    use HasFactory;
    protected $fillable = ['hostname', 'blocked_at', 'repealed_at'];

    /**
     * 現在ブロックされているサーバーのリストを取得する.
     * @return Collection
     */
    public static function listNotRepealed(): Collection
    {
        return self::whereNull('repealed_at')->get();
    }

    /**
     * 現在ブロックされているサーバーのIDを取得する.
     * バリデーションチェック用.
     * @return array
     */
    public static function idsNotRepealed(): array
    {
        return self::whereNull('repealed_at')->pluck('id')->toArray();
    }
}
