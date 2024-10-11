<?php

namespace App\Services\DocumentSources;

use App\Services\DocumentSources\DocumentSource;

class ClassicArchiveSource implements DocumentSource
{

    /**
     * @inheritDoc
     */
    public function getDocuments(): array
    {
        return array_map(function ($redirectTable) {
            $document = new DocumentData();
            $document->title = $redirectTable['title'];
            $document->url = $redirectTable['new_url'];
            // configには日付のみで書かれているが、念のため時刻情報を付加する
            $publishedAtDate = $redirectTable['published_at'];
            $document->publishedAt = "{$publishedAtDate}T00:00:00+09:00";
            return $document;
        }, config('inherited_data.redirect_table'));
    }

    /**
     * @inheritDoc
     */
    public function getSourceName(): string
    {
        return 'Classic Notes Archive';
    }
}
