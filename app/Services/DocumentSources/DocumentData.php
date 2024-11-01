<?php
/*
 * SPDX-FileCopyrightText: 2024 Kuropen <hy-kuropen@eternie-labs.net>
 * SPDX-License-Identifier: LicenseRef-KUROPEN-ORG-PUBLIC-CODE
 */

namespace App\Services\DocumentSources;

class DocumentData
{
    public string $title;
    public string $url;
    public string $publishedAt;
    public string $sourceName;
    public ?string $misskey_note_id;
}
