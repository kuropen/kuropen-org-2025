<?php
/*
 * SPDX-FileCopyrightText: 2024 Kuropen <webmaster@kuropen.org>
 * SPDX-License-Identifier: LicenseRef-KUROPEN-ORG-PUBLIC-CODE
 */

namespace App\Console\Commands;

use App\Models\InquiryRecipient;
use App\Models\MisskeyBatchToken;
use App\Services\ExternalApi\Misskey\MisskeyAdminApi;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class InquiryRecipientRegisterCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inquiry:recipient-register';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Register inquiry recipients';

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

        // Misskeyのユーザー情報を取得する
        $this->info('Fetching users...');

        $users = $api->getUsers($adminToken->getDecryptedToken(), ['origin' => 'local']);

        $this->info('Checking inquiry recipients...');

        $this->withProgressBar($users, function($user) {
            if ($this->isRecipient($user)) {
                $recipientRecord = InquiryRecipient::withTrashed()->where('misskey_id', $user['id'])->first();
                if (filled($recipientRecord) && $recipientRecord->exists) {
                    if ($recipientRecord->trashed()) {
                        Log::info("Restoring recipient: {$user['username']}");
                        $recipientRecord->restore();
                    }
                    $recipientRecord->update(['username' => $user['username'], 'is_admin' => $user['isAdmin']]);
                } else {
                    Log::info("Registering new recipient: {$user['username']}");
                    $recipientRecord = InquiryRecipient::create(['misskey_id' => $user['id'], 'username' => $user['username'], 'is_admin' => $user['isAdmin']]);
                }
                $recipientRecord->save();
            } else if (filled($pastRecipient = InquiryRecipient::where('misskey_id', $user['id'])->first())) {
                Log::info("Deleting past recipient: {$pastRecipient->username}");
                $pastRecipient->delete();
            }
        });
        $this->newLine();
        $this->info('Inquiry recipients registered.');
        $count = InquiryRecipient::count();
        $noun = $count === 1 ? 'recipient' : 'recipients';
        $this->info("Total: {$count} {$noun}");
    }

    private function isRecipient(array $user): bool
    {
        $isAdmin = isset($user['isAdmin']) && $user['isAdmin'];
        $isModerator = isset($user['isModerator']) && $user['isModerator'];
        $isBot = isset($user['isBot']) && $user['isBot'];
        return ($isAdmin || $isModerator) && !$isBot;
    }
}
