<?php
/*
 * SPDX-FileCopyrightText: 2024 Kuropen <webmaster@kuropen.org>
 * SPDX-License-Identifier: LicenseRef-KUROPEN-ORG-PUBLIC-CODE
 */

namespace App\Http\Controllers;

class HealthCheckApiController extends Controller
{
    public function healthCheck()
    {
        // 元のヘルスチェックAPIの形式に合わせる
        return response()->json([
            'time' => now()->toISOString(),
            'alive' => [
                'backend' => true,
                'frontend' => true,
            ],
        ]);
    }
}
