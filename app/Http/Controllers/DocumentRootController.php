<?php
/*
 * SPDX-FileCopyrightText: 2024 Kuropen <hy-kuropen@eternie-labs.net>
 * SPDX-License-Identifier: LicenseRef-KUROPEN-ORG-PUBLIC-CODE
 */

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class DocumentRootController extends Controller
{
    public function index()
    {
        $documents = Document::limit(5)->orderBy('published_at', 'desc')->get();
        return view('home', compact('documents'));
    }

    public function privacy()
    {
        return redirect()->route('legal');
    }
}
