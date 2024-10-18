<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
