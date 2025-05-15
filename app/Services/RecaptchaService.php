<?php
/*
 * SPDX-FileCopyrightText: 2024 Kuropen <webmaster@kuropen.org>
 * SPDX-License-Identifier: LicenseRef-KUROPEN-ORG-PUBLIC-CODE
 */

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

/**
 * reCAPTCHA Enterpriseのサービスクラス
 */
class RecaptchaService
{
    /**
     * reCAPTCHA Enterpriseのアセスメントを作成する
     * @param Request $request
     * @param string $action
     * @param string $token
     * @return array
     */
    public function createAssessment(Request $request, string $action, string $token): array
    {
        $project = config('const.google_cloud.project');
        $apiKey = config('const.google_cloud.api_key');
        $url = "https://recaptchaenterprise.googleapis.com/v1/projects/{$project}/assessments?key={$apiKey}";
        $data = [
            'event' => [
                'token' => $token,
                'siteKey' => config('const.recaptcha.site_key'),
                'expectedAction' => $action,
                'userIpAddress' => $request->ip(),
                'userAgent' => $request->header('User-Agent'),
            ],
        ];
        $response = Http::withBody(json_encode($data), 'application/json')->post($url)->json();
        return $response;
    }
}
