<?php
/*
 * SPDX-FileCopyrightText: 2024 Kuropen <hy-kuropen@eternie-labs.net>
 * SPDX-License-Identifier: LicenseRef-KUROPEN-ORG-PUBLIC-CODE
 */

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\LoadDocumentLog;

class PlanetController extends Controller
{
    public function index()
    {
        $lastRunLog = LoadDocumentLog::where('is_success', true)
            ->orderBy('run_date', 'desc')
            ->first();
        // 検索範囲は過去1週間以内かつ100件
        $documents = Document::orderBy('published_at', 'desc')
            ->where('published_at', '>=', now()->subWeek())
            ->limit(100)
            ->get();

        // 次に到来する30分または00分の時刻を取得し、Expiresヘッダとcache-controlを設定
        // ただし #22 対策で2分ずらす
        $delta = 30 - (now()->minute % 30) + 2;
        $deltaInSec = $delta * 60;
        $expires = now()->addMinutes($delta)->setSeconds(0);

        return response()
            ->view('planet', compact('documents', 'lastRunLog'))
            ->header('Expires', $expires->toRfc7231String())
            ->header('Cache-Control', 'public, max-age=' . $deltaInSec);
    }
}
