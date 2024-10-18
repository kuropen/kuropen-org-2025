<?php

namespace App\Http\Middleware;

use App\Services\AreaCheckService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MisskeyAreaCheckMiddleware
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
        $isUnavailable = !$this->areaCheckService->checkMisskeyAvailableArea();

        if ($isUnavailable) {
            // リクエスト元の国がMisskeyの利用が制限されている国である場合は、
            // 451 Unavailable For Legal Reasonsを返す
            return response()
                ->view('misskey_information.unavailable_country')
                ->setStatusCode(451);
        }
        return $next($request);
    }
}
