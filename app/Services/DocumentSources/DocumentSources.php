<?php

namespace App\Services\DocumentSources;

/**
 * Documentテーブルへの格納対象となるデータソースを取得する処理のクラス.
 */
class DocumentSources
{
    /**
     * @var class-string<DocumentSource>[]
     */
    private static array $availableSources = [
        ClassicArchiveSource::class,
        SizuMeSource::class,
    ];

    /**
     * Documentテーブルへの格納対象となるデータソースを取得する.
     * @return array<DocumentSource>
     */
    public static function getAvailableSources(): array
    {
        $sources = [];
        foreach (self::$availableSources as $source) {
            $sources[] = new $source();
        }
        return $sources;
    }
}
