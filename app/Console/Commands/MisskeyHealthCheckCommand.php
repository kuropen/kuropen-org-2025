<?php

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

        Cache::put(config('const.misskey.availability_key'), $isAlive, \DateInterval::createFromDateString('5 minutes'));
    }
}
