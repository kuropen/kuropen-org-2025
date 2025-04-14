<?php
/*
 * SPDX-FileCopyrightText: 2024 Kuropen <hy-kuropen@eternie-labs.net>
 * SPDX-License-Identifier: LicenseRef-KUROPEN-ORG-PUBLIC-CODE
 */

return [
    'site_description' => 'こちらはKuropenの個人サイトです。',
    'mail_send_to' => env('MAIL_SEND_TO'),
    'mail_send_from' => env('MAIL_FROM_ADDRESS'),
    'nip05' => [
        'accepted_handle' => [
            '_',
            'kuropen',
        ],
        'hex' => env('NIP05_HEX'),
        'relays' => [
            'wss://yabu.me/',
            'wss://nostr-relay.nokotaro.com/'
        ],
    ],
    'sizu_me' => [
        'api_url_prefix' => 'https://sizu.me/api/v1',
        'api_key' => env('SIZU_ME_API_KEY'),
    ],
    'dataSources' => [
        'literatures' => [
            'sizu.me',
            'Classic Notes Archive',
        ],
        'microblogs' => [
            'bluesky',
            'misskey',
        ],
    ],
    'misskey' => [
        'availability_key' => 'misskey_available',
        'notification_account' => env('INQUIRY_NOTIFICATION_ACCOUNT', 'info'),
        'host' => 'https://mi.kuropen.org',
        'unavailable_countries' => [
            "AT", "BE", "BG", "CH", "CY", "CZ", "DE", "DK", "EE", "ES",
            "FI", "FR", "GR", "HU", "IE", "IT", "LT", "LU", "LV", "MT",
            "NL", "PL", "PT", "RO", "SE", "SK", "SI", "IS", "LI", "NO",
            "GB", "T1", "AU",
        ],
    ],
    'bluesky' => [
        'proxy_url' => env('ATP_PROXY_URL', 'http://atp-proxy.railway.internal:3000'),
    ],
    'staff_zone' => [
        'access_token_key' => 'staff_access_token',
        'current_user_info_key' => 'staff_current_user_info',
        'landing_url_key' => 'staff_landing_url',
    ],
    'cookie_policy_confirmation_key' => 'cookie_policy_confirmation',
    'recaptcha' => [
        'site_key' => env('RECAPTCHA_SITE_KEY'),
        'threshold' => 0.5,
    ],
    'google_cloud' => [
        'project' => env('GCP_PROJECT_ID'),
        'api_key' => env('GCP_API_KEY'),
    ],
    'sql_log' => [
        'slow_query_time' => 2000,
    ],
];
