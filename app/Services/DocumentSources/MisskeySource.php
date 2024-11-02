<?php
/*
 * SPDX-FileCopyrightText: 2024 Kuropen <hy-kuropen@eternie-labs.net>
 * SPDX-License-Identifier: LicenseRef-KUROPEN-ORG-PUBLIC-CODE
 */

namespace App\Services\DocumentSources;

use App\Models\Document;
use App\Models\InquiryRecipient;
use App\Services\ExternalApi\Misskey\MisskeyNoteApi;

class MisskeySource implements DocumentSource
{

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

        $params = [
            'userId' => $targetUser->misskey_id,
            'withReplies' => true,
            'withRenotes' => true,
            'withChannelNotes' => false,
            'limit' => 100,
            // 書き直しの可能性があるため、10分前までのノートを取得
            'untilDate' => now()->subMinutes(10)->getTimestampMs(),
        ];

        // 最後に記録した投稿のIDを取得
        $lastMisskeyDocument = Document::where('data_source', $this->getSourceName())
            ->whereNotNull('misskey_note_id')
            ->orderBy('published_at', 'desc')
            ->first();
        if ($lastMisskeyDocument) {
            $params['sinceId'] = $lastMisskeyDocument->misskey_note_id;
        } else {
            // misskey_note_id カラムが追加された後の投稿がまだ記録されていないときは、
            // https://mi.kuropen.org/ からURLが始まる記録済みの投稿を使う
            $lastMisskeyDocument = Document::where('data_source', $this->getSourceName())
                ->where('url', 'like', 'https://mi.kuropen.org/%')
                ->orderBy('published_at', 'desc')
                ->first();
            if ($lastMisskeyDocument) {
                $params['sinceId'] = str($lastMisskeyDocument->url)->afterLast('/')->toString();
            }
        }

        $notes = $this->misskeyNoteApi->getNoteByUser($params);

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
                $text = "RN @{$renoted['user']['username']}@{$renoted['user']['host']}: {$renoteText}";
                $url = $renoted['url'] ?? $renoted['uri'];
            } else if ($note['cw']) {
                // Content Warningがある場合はその内容を表示
                $text = $note['cw'];
            }

            $document->title = str($text)->limit(100)->toString();
            $document->url = $url;
            $document->publishedAt = $note['createdAt'];
            $document->sourceName = $this->getSourceName();
            $document->misskey_note_id = $note['id'];
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
}
