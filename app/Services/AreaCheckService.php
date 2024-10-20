<?php
/*
 * SPDX-FileCopyrightText: 2024 Kuropen <hy-kuropen@eternie-labs.net>
 * SPDX-License-Identifier: LicenseRef-KUROPEN-ORG-PUBLIC-CODE
 */

namespace App\Services;

use Illuminate\Http\Request;

/**
 * 接続元の国をチェックする
 */
class AreaCheckService
{
    public function __construct(
        private readonly Request $request
    )
    {
    }

    /**
     * Misskeyの利用を認めている地域かどうかをチェックする
     * @return bool
     */
    public function checkMisskeyAvailableArea(): bool
    {
        // デバッグ用に変数にしておく
        $isUnavailable = false;

        // CF-IPCountryヘッダが存在する場合は、そのヘッダに記載された国コードをチェックする
        if ($this->request->header('CF-IPCountry')) {
            $countryCode = $this->request->header('CF-IPCountry');
            $unavailableCountries = config('const.misskey.unavailable_countries');
            $isUnavailable = in_array($countryCode, $unavailableCountries, true);
        }

        // メソッド名に合わせるため、利用できなければfalseを返す
        return !$isUnavailable;
    }

    /**
     * Torネットワークからのアクセスかどうかをチェックする
     */
    public function checkTorNetwork(): bool
    {
        // デバッグ用に変数にしておく
        $isTor = false;

        // CF-IPCountryヘッダが存在する場合は、そのヘッダに記載された国コードをチェックする
        if ($this->request->header('CF-IPCountry')) {
            $countryCode = $this->request->header('CF-IPCountry');
            $isTor = $countryCode === 'T1';
        }

        // メソッド名に合わせるため、Torネットワークからのアクセスであればtrueを返す
        return $isTor;
    }
}
