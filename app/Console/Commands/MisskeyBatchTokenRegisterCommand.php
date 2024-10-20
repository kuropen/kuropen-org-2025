<?php
/*
 * SPDX-FileCopyrightText: 2024 Kuropen <hy-kuropen@eternie-labs.net>
 * SPDX-License-Identifier: LicenseRef-KUROPEN-ORG-PUBLIC-CODE
 */

namespace App\Console\Commands;

use App\Models\MisskeyBatchToken;
use App\Services\ExternalApi\Misskey\MiAuth;
use App\Services\ExternalApi\Misskey\MisskeyUserApi;
use Illuminate\Console\Command;
use Ramsey\Uuid\Uuid;

class MisskeyBatchTokenRegisterCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'misskey:register-token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Register Misskey token for batch';

    /**
     * Execute the console command.
     */
    public function handle(MiAuth $miAuth, MisskeyUserApi $userApi): void
    {
        $forRole = $this->choice('Which role do you want to register?', ['admin', 'normal'], 'normal');
        $isAdmin = $forRole === 'admin';

        $sessionUuid = Uuid::uuid4();
        $permission = $isAdmin ? [
            'read:admin:meta', 'read:admin:show-user', 'read:account',
        ] : [
            'write:notes', 'read:account',
        ];
        $authRequestUrl = $miAuth->getAuthRequestUrl($sessionUuid, null, $permission);
        $this->info('Please access the following URL and authenticate.');
        $this->info($authRequestUrl);
        $this->ask('After authentication, press enter key to continue');
        $token = $miAuth->getAccessToken($sessionUuid);

        $user = $userApi->getUserInfo($token);

        MisskeyBatchToken::storeToken([
            'token' => $token,
            'is_admin' => $isAdmin,
            'permission' => implode(',', $permission),
            'for_user' => $user['username'],
        ]);
        $this->info('Token has been registered.');
    }
}
