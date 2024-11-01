<?php
/*
 * SPDX-FileCopyrightText: 2024 Kuropen <hy-kuropen@eternie-labs.net>
 * SPDX-License-Identifier: BSL-1.0
 */

namespace App\Services\ExternalApi\Misskey;

use Illuminate\Support\Facades\Log;

class MisskeyNoteApi extends MisskeyApiCommunicator
{
    /**
     * ノートを作成する.
     * @param string $accessToken
     * @param array{
     *     visibility: 'public' | 'home' | 'followers' | 'specified',
     *     text: string,
     *     visibleUserIds?: string[],
     *     cw?: string,
     *     localOnly?: boolean,
     *     reactionAcceptance?: string,
     *     noExtractMentions?: boolean,
     *     noExtractHashtags?: boolean,
     *     noExtractEmojis?: boolean,
     *     replyId?: string,
     *     renoteId?: string,
     *     channelId?: string,
     *     fileIds?: string[],
     *     poll?: array,
     * } $params
     * @return mixed
     */
    public function createNote(string $accessToken, array $params)
    {
        return $this->request('/api/notes/create', $accessToken, $params);
    }

    /**
     * 指定したユーザーのノートを取得する.
     * @param array{
     *     userId: string,
     *     withReplies?: boolean,
     *     withRenotes?: boolean,
     *     withChannelNotes?: boolean,
     *     limit?: number,
     *     sinceId?: string,
     *     untilId?: string,
     *     sinceDate?: number,
     *     untilDate?: number,
     *     allowPartial?: boolean,
     *     withFiles?: boolean,
     * } $params
     * @return array|mixed
     */
    public function getNoteByUser(array $params)
    {
        Log::debug('MisskeyNoteApi::getNoteByUser', $params);
        return $this->request('/api/users/notes', params: $params);
    }
}
