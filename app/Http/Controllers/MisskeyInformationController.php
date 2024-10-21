<?php
/*
 * SPDX-FileCopyrightText: 2024 Kuropen <hy-kuropen@eternie-labs.net>
 * SPDX-License-Identifier: LicenseRef-KUROPEN-ORG-PUBLIC-CODE
 */

namespace App\Http\Controllers;

use App\Http\Requests\BlockedServerInformationRequest;
use App\Models\BlockedFediverseServer;
use Illuminate\Http\Request;

class MisskeyInformationController extends Controller
{
    public function index()
    {
        return view('misskey_information.top');
    }
    public function blockedServers(BlockedServerInformationRequest $request)
    {
        $showRepealed = $request->input('repealed', false);
        $oldestBlockDate = BlockedFediverseServer::orderBy('blocked_at')->first()->blocked_at;
        $blockedListQuery = BlockedFediverseServer::orderBy('blocked_at');
        if ($showRepealed) {
            $blockedListQuery->whereNotNull('repealed_at');
        } else {
            $blockedListQuery->whereNull('repealed_at');
        }
        $blockedList = $blockedListQuery->get();
        return response()->view(
            'misskey_information.block_list',
             compact('oldestBlockDate', 'blockedList', 'showRepealed'),
        )->header('X-Robots-Tag', 'noindex'); // ブロックリストは検索エンジンにインデックスされないようにする
    }
    public function howToFollow()
    {
        return view('misskey_information.how_to_follow');
    }
}
