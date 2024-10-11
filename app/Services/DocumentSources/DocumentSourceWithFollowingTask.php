<?php

namespace App\Services\DocumentSources;

use App\Services\DocumentSources\DocumentSource;

/**
 * 後処理を行うDocumentSourceのインターフェイス.
 */
interface DocumentSourceWithFollowingTask extends DocumentSource
{
    /**
     * 後処理を行う.
     * @return void
     */
    public function done(): void;
}
