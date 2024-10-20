<?php
/*
 * SPDX-FileCopyrightText: 2024 Kuropen <hy-kuropen@eternie-labs.net>
 * SPDX-License-Identifier: LicenseRef-KUROPEN-ORG-PUBLIC-CODE
 */

namespace App\Services\DocumentSources;

/**
 * 書いたもの一覧に表示するコンテンツを取得する処理のインターフェイス.
 */
interface DocumentSource
{
    /**
     * 書いたもの一覧に表示するコンテンツを取得する.
     * @return array<DocumentData>
     */
    public function getDocuments(): array;

    /**
     * データソースの名前を取得する.
     * コンソールに出力されるので英文で記述すること.
     * @return string
     */
    public function getSourceName(): string;
}
