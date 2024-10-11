<?php

namespace App\Models;

use App\Services\DocumentSources\DocumentData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'url',
        'published_at',
    ];

    /**
     * DocumentSourceから取得したデータをDocumentテーブルに格納する.
     * @param array<DocumentData> $documents
     * @return void
     */
    public static function storeDocuments(array $documents): void
    {
        foreach ($documents as $document) {
            self::updateOrCreate(
                ['url' => $document->url],
                [
                    'title' => $document->title,
                    'published_at' => $document->publishedAt,
                ]
            );
        }
    }

}
