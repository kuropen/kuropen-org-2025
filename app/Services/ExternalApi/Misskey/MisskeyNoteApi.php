<?php

namespace App\Services\ExternalApi\Misskey;

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
}
