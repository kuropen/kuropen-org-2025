<?php
/*
 * SPDX-FileCopyrightText: 2024 Kuropen <hy-kuropen@eternie-labs.net>
 * SPDX-License-Identifier: LicenseRef-KUROPEN-ORG-PUBLIC-CODE
 */

namespace App\Http\Controllers;

use App\Http\Requests\Nip05Request;

class NostrController extends Controller
{
    public function nip05(Nip05Request $request)
    {
        $hex = config('const.nip05.hex');
        if (blank($hex)) {
            abort(503, 'Nostr account information is not yet configured. Please contact to the administrator.');
        }

        $namesHexList = [];
        foreach (config('const.nip05.accepted_handle') as $name) {
            if (filled($requestedName = $request->get('name')) && $name !== $requestedName) {
                continue;
            }
            $namesHexList[$name] = $hex;
        }
        $response = [
            'names' => $namesHexList,
        ];
        if (filled(config('const.nip05.relays'))) {
            $response['relays'] = [
                "$hex" => config('const.nip05.relays'),
            ];
        }
        return response()->json($response);
    }
}
