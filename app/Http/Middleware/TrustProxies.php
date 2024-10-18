<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Illuminate\Http\Request;

class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * @var array<int, string>|string|null
     */
    protected $proxies;

    /**
     * The headers that should be used to detect proxies.
     *
     * @var int
     */
    protected $headers = Request::HEADER_X_FORWARDED_PROTO;
//        Request::HEADER_X_FORWARDED_FOR |
//        Request::HEADER_X_FORWARDED_HOST |
//        Request::HEADER_X_FORWARDED_PORT |
//        Request::HEADER_X_FORWARDED_PROTO |
//        Request::HEADER_X_FORWARDED_AWS_ELB;

    // WARNING: index.php で CF-Connecting-IP を REMOTE_ADDR に代入するため、
    // X-Forwarded-For, X-Forwarded-Host は使わない。
    // X-Forwarded-Proto は、 https を検出するために使う。
}
