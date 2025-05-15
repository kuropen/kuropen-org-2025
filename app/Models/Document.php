<?php
/*
 * SPDX-FileCopyrightText: 2024 Kuropen <webmaster@kuropen.org>
 * SPDX-License-Identifier: LicenseRef-KUROPEN-ORG-PUBLIC-CODE
 */

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
        'data_source',
        'misskey_note_id',
        'is_repost',
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
                    'data_source' => $document->sourceName,
                    'is_repost' => $document->is_repost,
                ]
            );
        }
    }

    /**
     * 指定したデータソースのドキュメントを取得する.
     * @param string|array|null $sources
     * @param int $limit
     * @return array
     */
    public static function getDocumentsOfSources(string|array|null $sources, int $limit = 100): array
    {
        $model = self::select();
        if (!empty($sources)) {
            if (is_string($sources)) {
                $sources = [$sources];
            }
            $model = $model->whereIn('data_source', $sources);
        }

        return $model
            ->orderBy('published_at', 'desc')
            ->limit($limit)
            ->get()
            ->toArray();
    }

}
