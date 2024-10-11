<?php
return [
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
];
