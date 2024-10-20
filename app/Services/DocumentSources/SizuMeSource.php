<?php
/*
 * SPDX-FileCopyrightText: 2024 Kuropen <hy-kuropen@eternie-labs.net>
 * SPDX-License-Identifier: LicenseRef-KUROPEN-ORG-PUBLIC-CODE
 */

namespace App\Services\DocumentSources;

use App\Services\ExternalApi\SizuMeApi;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

/**
 * 「しずかなインターネット」のコンテンツを取得する処理.
 */
class SizuMeSource implements DocumentSourceWithFollowingTask
{
    const LAST_RUN_DATE_CACHE_KEY = 'sizu_me_source_last_run_date';

    /**
     * @inheritDoc
     */
    public function getDocuments(): array
    {
        $params = [
            'sort' => 'created',
            'direction' => 'asc',
            'visibility' => 'ANYONE',
            'perPage' => 100,
        ];

        // キャッシュから最終実行日時を取得
        $lastRunDate = Cache::get(self::LAST_RUN_DATE_CACHE_KEY);
        if ($lastRunDate) {
            $params['updatedAfter'] = $lastRunDate;
        }

        try {
            $sizuMeArticles = SizuMeApi::getPosts($params)['posts'];
        } catch (\RuntimeException $e) {
            if (app()->hasDebugModeEnabled()) {
                throw $e;
            }
            Log::error($e->getMessage());
            return [];
        }

        return array_map(function ($article) {
            $document = new DocumentData();
            $slug = $article['slug'];
            $document->title = $article['title'];
            $document->url = "https://sizu.me/kuropen/posts/{$slug}";
            $document->publishedAt = $article['createdAt'];
            return $document;
        }, $sizuMeArticles);
    }

    public function getSourceName(): string
    {
        return 'sizu.me';
    }

    /**
     * @inheritDoc
     */
    public function done(): void
    {
        // 最終実行日時をキャッシュに保存
        $lastRunDate = now()->toIso8601String();
        Cache::forever(self::LAST_RUN_DATE_CACHE_KEY, $lastRunDate);
    }

    /**
     * 最終実行日時をリセットする.
     * @param string|null $overwrittenDate 上書きする日時
     * @return void
     */
    public static function reset(string|null $overwrittenDate = null): void
    {
        if ($overwrittenDate) {
            Cache::forever(self::LAST_RUN_DATE_CACHE_KEY, $overwrittenDate);
            return;
        }
        Cache::forget(self::LAST_RUN_DATE_CACHE_KEY);
    }
}
