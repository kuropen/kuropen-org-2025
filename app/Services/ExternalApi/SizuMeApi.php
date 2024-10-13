<?php

namespace App\Services\ExternalApi;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use RuntimeException;
use Illuminate\Support\Facades\Http;

/**
 * 「しずかなインターネット」のAPIを利用するためのクラス.
 */
class SizuMeApi
{
    /**
     * 投稿一覧を取得する.
     * @param array{
     *     page?: int,
     *     perPage?: int,
     *     sort?: 'created' | 'updated',
     *     direction?: 'asc' | 'desc',
     *     visibility?: 'ANYONE' | 'MYSELF' | 'URL_ONLY',
     *     createdAfter?: Carbon | string,
     *     createdBefore?: Carbon | string,
     *     updatedAfter?: Carbon | string,
     *     updatedBefore?: Carbon | string,
     * } $params
     * @return array{
     *     posts: array{
     *     slug: string,
     *     title: string,
     *     published_at: string,
     *     bodyCharacterCount: int,
     *     visibility: 'ANYONE' | 'MYSELF' | 'URL_ONLY',
     *     tags: array<string>,
     *     },
     *     pagination: array{
     *     currentPage: int,
     *     nextPage: int | null,
     *     prevPage: int | null,
     *     perPage: int,
     *     sort: 'created' | 'updated',
     *     direction: 'asc' | 'desc',
     *     },
     * }
     */
    public static function getPosts(array $params = []): array
    {
        if (empty(config('const.sizu_me.api_key'))) {
            Log::error('SizuMe API key is not set.');
            throw new RuntimeException('SizuMe API key is not set.');
        }

        $defaultParams = [
            // 安全上の理由から、デフォルトでは公開投稿のみ取得する
            'visibility' => 'ANYONE',
        ];
        $paramsSent = array_merge($defaultParams, $params);
        $sizuMeResponse = Http::withUrlParameters($paramsSent)
            ->acceptJson()
            ->withToken(config('const.sizu_me.api_key'))
            ->get(config('const.sizu_me.api_url_prefix') . '/posts');

        if ($sizuMeResponse->failed()) {
            Log::error('Failed to get documents from SizuMe.', [
                'response' => $sizuMeResponse->body(),
            ]);
            throw new RuntimeException('Failed to get documents from SizuMe.');
        }

        return $sizuMeResponse->json();
    }
}
