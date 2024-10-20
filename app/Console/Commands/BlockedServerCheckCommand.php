<?php
/*
 * SPDX-FileCopyrightText: 2024 Kuropen <hy-kuropen@eternie-labs.net>
 * SPDX-License-Identifier: LicenseRef-KUROPEN-ORG-PUBLIC-CODE
 */

namespace App\Console\Commands;

use App\Models\BlockedFediverseServer;
use App\Models\MisskeyBatchToken;
use App\Services\ExternalApi\Misskey\MisskeyAdminApi;
use Illuminate\Console\Command;

class BlockedServerCheckCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'misskey:check-blocked';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check the blocked server on misskey';

    /**
     * Execute the console command.
     */
    public function handle(MisskeyAdminApi $api): void
    {
        // 管理者権限を持つMisskeyのAPIトークンが登録されているか確認する
        while(true) {
            try {
                $adminToken = MisskeyBatchToken::where('is_admin', true)->firstOrFail();
                break;
            } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
                $this->warn('No admin token found. Register an admin token first.');
                $this->call('misskey:register-token');
            }
        }

        // サーバーメタデータの取得
        $this->info('Fetching metadata...');
        $metadata = $api->getMetadata($adminToken->getDecryptedToken());

        // ブロックされたサーバーの確認
        $this->info('Checking blocked servers...');
        $currentBlockedServers = $metadata->blockedHosts;

        // 保存されたブロック対象サーバーについて、現在のブロック対象サーバーに含まれていないものを解除されたものとして保存する
        $savedBlockedServers = BlockedFediverseServer::whereNull('repealed_at')->get();
        foreach ($savedBlockedServers as $savedBlockedServer) {
            if (!in_array($savedBlockedServer->hostname, $currentBlockedServers)) {
                $savedBlockedServer->repealed_at = now();
                $savedBlockedServer->save();
                $this->info("Repealed blocked server: {$savedBlockedServer->hostname}");
            }
        }

        // 現在のブロック対象サーバーについて、保存されたブロック対象サーバーに含まれていないものを新たに保存する
        foreach ($currentBlockedServers as $currentBlockedServer) {
            // もし解除されていた状態で保存されていれば、解除されていないものとする
            $record = BlockedFediverseServer::where('hostname', $currentBlockedServer)
                ->first();
            if (filled($record) && !is_null($record->repealed_at)) {
                $record->blocked_at = now();
                $record->repealed_at = null;
                $record->save();
                $this->info("Unrepealed blocked server: {$currentBlockedServer}");
            } else if (!$savedBlockedServers->contains('hostname', $currentBlockedServer)) {
                BlockedFediverseServer::create([
                    'hostname' => $currentBlockedServer,
                    'blocked_at' => now(),
                ]);
                $this->info("Blocked server (new): {$currentBlockedServer}");
            } else {
                $this->info("Blocked server (not updated): {$currentBlockedServer}");
            }
        }
    }
}
