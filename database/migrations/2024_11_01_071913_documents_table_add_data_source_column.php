<?php
/*
 * SPDX-FileCopyrightText: 2024 Kuropen <hy-kuropen@eternie-labs.net>
 * SPDX-License-Identifier: LicenseRef-KUROPEN-ORG-PUBLIC-CODE
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('Documents', function (Blueprint $table) {
            $table->string('data_source')->nullable()->after('published_at');
        });
    }

    public function down(): void
    {
        Schema::table('Documents', function (Blueprint $table) {
            $table->dropColumn('data_source');
        });
    }
};
