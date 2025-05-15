<?php
/*
 * SPDX-FileCopyrightText: 2024 Kuropen <webmaster@kuropen.org>
 * SPDX-License-Identifier: LicenseRef-KUROPEN-ORG-PUBLIC-CODE
 */

namespace App\Services;

use Illuminate\Support\Carbon;
use Webuni\FrontMatter\FrontMatter;

class CookiePolicyService
{
    public function __construct(
        private readonly FrontMatter $frontMatter
    )
    {
        // constructor
    }

    /**
     * プライバシーポリシーファイルの最終更新日時を取得
     * @return int
     */
    public function getLastDocumentUpdatedTime(): int
    {
        $legalFilePath = resource_path('md/legal.md');

        // FrontMatterを使ってファイルの最終更新日時を取得
        $document = $this->frontMatter->parse(file_get_contents($legalFilePath));
        $lastModified = $document->getData()['lastUpdated'];
        if ($lastModified) {
            return Carbon::make($lastModified)->timezone('Asia/Tokyo')->timestamp;
        }

        // FrontMatterがない場合はファイルの最終更新日時を取得
        return filemtime($legalFilePath);
    }

    /**
     * プライバシーポリシーに同意したことを示すCookieを生成
     * @return \Symfony\Component\HttpFoundation\Cookie
     */
    public function makeConfirmationCookie(?int $currentTime = null): \Symfony\Component\HttpFoundation\Cookie
    {
        if (!$currentTime) {
            $currentTime = time();
        }
        return cookie(config('const.cookie_policy_confirmation_key'), $currentTime, 60 * 24 * 365);
    }
}
