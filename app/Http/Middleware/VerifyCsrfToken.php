<?php
/*
 * SPDX-FileCopyrightText: 2024 Kuropen <hy-kuropen@eternie-labs.net>
 * SPDX-License-Identifier: LicenseRef-KUROPEN-ORG-PUBLIC-CODE
 */

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];
}
