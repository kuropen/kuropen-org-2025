<?php
/*
 * SPDX-FileCopyrightText: 2024 Kuropen <webmaster@kuropen.org>
 * SPDX-License-Identifier: LicenseRef-KUROPEN-ORG-PUBLIC-CODE
 */

namespace App\Http\Middleware;

use App\Services\AreaCheckService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TorDetectionMiddleware
{
    public function __construct(
        private readonly AreaCheckService $areaCheckService
    )
    {
        //
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $isTor = $this->areaCheckService->checkTorNetwork();
        if ($isTor) {
            // Torネットワークからのアクセスである場合は、
            // 403 Forbiddenを返す
            return response()
                ->view('unavailable_network')
                ->setStatusCode(403);
        }
        return $next($request);
    }
}
