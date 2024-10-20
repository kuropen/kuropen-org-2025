<?php
/*
 * SPDX-FileCopyrightText: 2024 Kuropen <hy-kuropen@eternie-labs.net>
 * SPDX-License-Identifier: LicenseRef-KUROPEN-ORG-PUBLIC-CODE
 */

namespace App\Console\Commands;

use App\Services\ExternalApi\Misskey\MisskeyApiCommunicator;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class MisskeyHealthCheckCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'misskey:health-check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Health check for Misskey';

    /**
     * Execute the console command.
     */
    public function handle(MisskeyApiCommunicator $communicator)
    {
        $pingResult = $communicator->request('/api/ping');
        $isAlive = array_key_exists('pong', $pingResult);

        if ($isAlive) {
            $this->info('Misskey is alive.');
        } else {
            $this->error('Misskey is dead.');
        }

        // cronの発火タイミングずれおよびRedis接続エラーによる不発を考慮して、11分間有効なキャッシュを設定する
        Cache::put(config('const.misskey.availability_key'), $isAlive, \DateInterval::createFromDateString('11 minutes'));
    }
}
