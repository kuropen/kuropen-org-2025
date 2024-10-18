<?php
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
    'misskey' => [
        'availability_key' => 'misskey_available',
        'notification_account' => env('INQUIRY_NOTIFICATION_ACCOUNT', 'info'),
        'host' => 'https://mi.kuropen.org',
        'unavailable_countries' => [
            "AT", "BE", "BG", "CH", "CY", "CZ", "DE", "DK", "EE", "ES",
            "FI", "FR", "GR", "HU", "IE", "IT", "LT", "LU", "LV", "MT",
            "NL", "PL", "PT", "RO", "SE", "SK", "SI", "IS", "LI", "NO",
            "GB", "T1",
        ],
    ],
    'staff_zone' => [
        'access_token_key' => 'staff_access_token',
        'current_user_info_key' => 'staff_current_user_info',
        'landing_url_key' => 'staff_landing_url',
    ],
    'cookie_policy_confirmation_key' => 'cookie_policy_confirmation',
];
