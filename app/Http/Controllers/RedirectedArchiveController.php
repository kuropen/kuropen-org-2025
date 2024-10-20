<?php
/*
 * SPDX-FileCopyrightText: 2024 Kuropen <hy-kuropen@eternie-labs.net>
 * SPDX-License-Identifier: LicenseRef-KUROPEN-ORG-PUBLIC-CODE
 */

namespace App\Http\Controllers;

use App\Models\RedirectedArchive;

class RedirectedArchiveController extends Controller
{
    public function index()
    {
        return redirect(config('app.url'), 301);
    }

    public function withSlug(string $slug)
    {
        $archive = RedirectedArchive::where('old_path', $slug)->firstOrFail();
        return redirect($archive->new_url, 303);
    }
}
