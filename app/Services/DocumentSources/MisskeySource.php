<?php
/*
 * SPDX-FileCopyrightText: 2024 Kuropen <hy-kuropen@eternie-labs.net>
 * SPDX-License-Identifier: LicenseRef-KUROPEN-ORG-PUBLIC-CODE
 */

namespace App\Services\DocumentSources;

use App\Models\InquiryRecipient;
use App\Services\ExternalApi\Misskey\MisskeyNoteApi;
use Illuminate\Support\Facades\Cache;

class MisskeySource implements DocumentSourceWithFollowingTask
{

    const string LAST_RUN_DATE_CACHE_KEY = 'misskey_source_last_run_date';

    private bool $isNotExecuted;

    private MisskeyNoteApi $misskeyNoteApi;

    public function __construct()
    {
        $this->isNotExecuted = false;
        $this->misskeyNoteApi = new MisskeyNoteApi();
    }

    /**
     * @inheritDoc
     */
    public function getDocuments(): array
    {
        $targetUser = InquiryRecipient::where('is_admin', true)->first();
        if (!$targetUser) {
            $this->isNotExecuted = true;
            return [];
        }
        $notes = $this->misskeyNoteApi->getNoteByUser([
            'userId' => $targetUser->misskey_id,
            'withReplies' => false,
            'withRenotes' => true,
            'withChannelNotes' => false,
            'limit' => 100,
        ]);

        return array_map(function ($note) {
            $document = new DocumentData();
            $text = $note['text'];
            $url = "https://mi.kuropen.org/notes/{$note['id']}";

            // 純粋Renoteの場合
            if (isset($note['renote']) && is_null($note['text'])) {
                $renoted = $note['renote'];
                $renoteText = $renoted['text'];
                if ($renoted['cw']) {
                    // Content Warningがある場合はその内容を表示
                    $renoteText = $renoted['cw'];
                }
                $text = "RN {$renoted['user']['username']}@{$renoted['user']['host']}: {$renoteText}";
                $url = $renoted['url'] ?? $renoted['uri'];
            } else if ($note['cw']) {
                // Content Warningがある場合はその内容を表示
                $text = $note['cw'];
            }

            $document->title = str($text)->limit(100);
            $document->url = $url;
            $document->publishedAt = $note['createdAt'];
            $document->sourceName = $this->getSourceName();
            return $document;
        }, $notes);
    }

    /**
     * @inheritDoc
     */
    public function getSourceName(): string
    {
        return 'misskey';
    }

    /**
     * @inheritDoc
     */
    public function done(): void
    {
        if ($this->isNotExecuted) {
            return;
        }
        // 最終実行日時をキャッシュに保存
        $lastRunDate = now()->toIso8601String();
        Cache::forever(self::LAST_RUN_DATE_CACHE_KEY, $lastRunDate);
    }
}
