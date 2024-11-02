<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('load_document_logs', function (Blueprint $table) {
            $table->id();
            $table->dateTime('run_date');
            $table->boolean('is_success');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('load_document_logs');
    }
};
