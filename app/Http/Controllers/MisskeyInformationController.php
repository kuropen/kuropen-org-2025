<?php
/*
 * SPDX-FileCopyrightText: 2024 Kuropen <hy-kuropen@eternie-labs.net>
 * SPDX-License-Identifier: LicenseRef-KUROPEN-ORG-PUBLIC-CODE
 */

namespace App\Http\Controllers;

use App\Models\BlockedFediverseServer;
use Illuminate\Http\Request;

class MisskeyInformationController extends Controller
{
    public function index()
    {
        return view('misskey_information.top');
    }
    public function blockedServers()
    {
        $oldestBlockDate = BlockedFediverseServer::orderBy('blocked_at')->first()->blocked_at;
        $blockedList = BlockedFediverseServer::orderBy('repealed_at')->orderBy('blocked_at')->get();
        return response()->view(
            'misskey_information.block_list',
             compact('oldestBlockDate', 'blockedList'),
        )->header('X-Robots-Tag', 'noindex'); // ブロックリストは検索エンジンにインデックスされないようにする
    }
    public function howToFollow()
    {
        return view('misskey_information.how_to_follow');
    }
}
