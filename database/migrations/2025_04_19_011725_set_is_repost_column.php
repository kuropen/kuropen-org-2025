<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // 既存のレコードに対してデフォルト値を設定
        \App\Models\Document::whereIn('data_source', ['misskey', 'bluesky'])
            ->each(function ($document) {
                $repostPrefix = null;
                if ($document->data_source === 'misskey') {
                    $repostPrefix = 'RN';
                } else if ($document->data_source === 'bluesky') {
                    $repostPrefix = 'RP';
                }
                $document->is_repost = $repostPrefix && str_starts_with($document->title, $repostPrefix);
                $document->save();
            });
    }

    public function down(): void
    {
        // 何もしない
    }
};
