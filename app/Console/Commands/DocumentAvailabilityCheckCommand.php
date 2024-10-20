<?php
/*
 * SPDX-FileCopyrightText: 2024 Kuropen <hy-kuropen@eternie-labs.net>
 * SPDX-License-Identifier: LicenseRef-KUROPEN-ORG-PUBLIC-CODE
 */

namespace App\Console\Commands;

use App\Models\Document;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DocumentAvailabilityCheckCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'document:check {--no-delete : Unavailable entry will not be deleted}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('Document availability check started. Fetching documents...');
        $documents = Document::all();
        $this->withProgressBar($documents, function (Document $document) {
            $isAvailable = $this->checkAvailability($document->url);
            if (!$isAvailable) {
                if (!$this->option('no-delete')) {
                    $document->delete();
                    Log::info('Document has been deleted.');
                }
            }
        });
        $this->newLine();
        $this->info('Document availability check completed.');
    }

    /**
     * Check the availability of the document.
     * @param $url
     * @return bool
     */
    function checkAvailability($url): bool
    {
        $headRequest = Http::head($url);
        if ($headRequest->successful()) {
            Log::info("{$url}: available");
            return true;
        } else if ($headRequest->serverError()) {
            Log::warning("{$url}: server error (maybe temporarily; not deleted)");
            return true;
        } else if ($headRequest->clientError()) {
            Log::error("{$url}: client error (deleted)");
            return false;
        } else {
            Log::warning("{$url}: unknown error (maybe our server error; not deleted)");
            return true;
        }
    }
}
