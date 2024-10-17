<?php

namespace App\Http\Controllers;

use App\Models\BlockedFediverseServer;
use Illuminate\Http\Request;

class MisskeyInformationController extends Controller
{
    public function blockedServers()
    {
        $oldestBlockDate = BlockedFediverseServer::orderBy('blocked_at')->first()->blocked_at;
        $blockedList = BlockedFediverseServer::orderBy('repealed_at', 'desc')->orderBy('blocked_at', 'desc')->get();
        return view('misskey_information.block_list', compact('blockedList', 'oldestBlockDate'));
    }
}
