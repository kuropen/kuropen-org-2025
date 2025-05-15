<?php
/*
 * SPDX-FileCopyrightText: 2024 Kuropen <webmaster@kuropen.org>
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
    public bool $is_repost = false;
}
