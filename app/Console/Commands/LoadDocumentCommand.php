<?php

namespace App\Console\Commands;

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
        $this->withProgressBar(DocumentSources::getAvailableSources(), function(DocumentSource $source) {
            $documents = $source->getDocuments();
            \App\Models\Document::storeDocuments($documents);
            if ($source instanceof DocumentSourceWithFollowingTask) {
                $source->done();
            }
        });
        $this->newLine();
        $this->info("Document Loading Finish.");
    }
}
