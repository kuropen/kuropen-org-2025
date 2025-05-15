<?php
/*
 * SPDX-FileCopyrightText: 2024 Kuropen <webmaster@kuropen.org>
 * SPDX-License-Identifier: LicenseRef-KUROPEN-ORG-PUBLIC-CODE
 */

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class DocumentRootController extends Controller
{
    public function index()
    {
        return response()
            ->view('home');
    }

    public function privacy()
    {
        return redirect()->route('legal');
    }
}
