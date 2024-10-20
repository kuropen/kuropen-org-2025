<?php
/*
 * SPDX-FileCopyrightText: 2024 Kuropen <hy-kuropen@eternie-labs.net>
 * SPDX-License-Identifier: LicenseRef-KUROPEN-ORG-PUBLIC-CODE
 */

namespace App\Console\Commands;

use App\Services\DocumentSources\SizuMeSource;
use Illuminate\Console\Command;

class SizuMeLastRunDateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'document:sizu-me-reset {--overwrite= : the last run date to be overwritten; if not set, the last run date will be reset}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset or overwrite the last run date of SizuMeSource';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $overwrittenDate = $this->option('overwrite');
        SizuMeSource::reset($overwrittenDate);

        $taskDone = $overwrittenDate ? "overwritten" : "reset";
        $this->info("Last run date of SizuMeSource has been {$taskDone}.");
    }
}
