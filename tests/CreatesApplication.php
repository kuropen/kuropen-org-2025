<?php

// SPDX-FileCopyrightText: 2024 Kuropen
//
// SPDX-License-Identifier: LicenseRef-KUROPEN-ORG-PUBLIC-CODE

namespace Tests;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Application;

trait CreatesApplication
{
    /**
     * Creates the application.
     */
    public function createApplication(): Application
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }
}
