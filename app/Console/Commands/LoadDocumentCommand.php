<?php
/*
 * SPDX-FileCopyrightText: 2024 Kuropen <hy-kuropen@eternie-labs.net>
 * SPDX-License-Identifier: LicenseRef-KUROPEN-ORG-PUBLIC-CODE
 */

namespace App\Console\Commands;

use App\Models\LoadDocumentLog;
use App\Services\DocumentSources\DocumentSource;
use App\Services\DocumentSources\DocumentSources;
use App\Services\DocumentSources\DocumentSourceWithFollowingTask;
use Illuminate\Console\Command;

class LoadDocumentCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'document:load';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Load linked documents from external source';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("Document Loading Start.");

        // 実行日時の記録
        $loadLog = new LoadDocumentLog();
        $loadLog->run_date = now();
        $loadLog->is_success = false;
        $loadLog->save();

        $this->withProgressBar(DocumentSources::getAvailableSources(), function(DocumentSource $source) {
            $documents = $source->getDocuments();
            \App\Models\Document::storeDocuments($documents);
            if ($source instanceof DocumentSourceWithFollowingTask) {
                $source->done();
            }
        });
        $this->newLine();

        $loadLog->is_success = true;
        $loadLog->save();

        $this->info("Document Loading Finish.");
    }
}
