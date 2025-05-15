<?php
/*
 * SPDX-FileCopyrightText: 2024 Kuropen <webmaster@kuropen.org>
 * SPDX-License-Identifier: LicenseRef-KUROPEN-ORG-PUBLIC-CODE
 */

namespace App\Services\DocumentSources;

/**
 * 後処理を行うDocumentSourceのインターフェイス.
 */
interface DocumentSourceWithFollowingTask extends DocumentSource
{
    /**
     * 後処理を行う.
     * @return void
     */
    public function done(): void;
}
