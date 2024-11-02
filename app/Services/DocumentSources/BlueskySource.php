<?php

namespace App\Services\DocumentSources;

use App\Services\DocumentSources\DocumentSource;
use Illuminate\Support\Facades\Http;

class BlueskySource implements DocumentSource
{

    /**
     * @inheritDoc
     */
    public function getDocuments(): array
    {
        $feed = Http::withQueryParameters(['limit' => 100])
            ->get(config('const.bluesky.proxy_url') . '/feed')
            ->json();

        $currentAccountDid = $feed['currentAccountDid'];

        return array_map(function ($item) use ($currentAccountDid) {
            $postItem = $item['post'];
            $postId = str($postItem['uri'])->afterLast('/')->toString();
            $authorDid = $postItem['author']['did'];
            $publishedAt = $postItem['record']['createdAt'];

            if ($authorDid !== $currentAccountDid) {
                // repost
                $text = "RP @{$postItem['author']['handle']}: {$postItem['record']['text']}";
                $publishedAt = $postItem['reason']['by']['createdAt'];
            } elseif (isset($item['reply'])) {
                $text = "@{$item['reply']['parent']['author']['handle']} {$postItem['record']['text']}";
            } else {
                $text = $postItem['record']['text'];
            }

            $document = new DocumentData();
            $document->title = str($text)->limit(100)->toString();
            $document->url = "https://bsky.app/profile/{$authorDid}/post/{$postId}";
            $document->publishedAt = $publishedAt;
            $document->sourceName = $this->getSourceName();
            return $document;
        }, $feed['data']['feed']);
    }

    /**
     * @inheritDoc
     */
    public function getSourceName(): string
    {
        return 'bluesky';
    }
}
