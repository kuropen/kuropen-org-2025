<?php
/*
 * SPDX-FileCopyrightText: 2024 Kuropen <hy-kuropen@eternie-labs.net>
 * SPDX-License-Identifier: LicenseRef-KUROPEN-ORG-PUBLIC-CODE
 */

namespace App\Http\Controllers;

use App\Models\Document;

class PlanetController extends Controller
{
    public function index()
    {
        // 検索範囲は過去1週間以内かつ100件
        $documents = Document::orderBy('published_at', 'desc')
            ->where('published_at', '>=', now()->subWeek())
            ->limit(100)
            ->get();
        return view('planet', ['documents' => $documents]);
    }
}
