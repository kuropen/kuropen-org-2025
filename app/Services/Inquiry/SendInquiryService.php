<?php

namespace App\Services\Inquiry;

use App\Models\InquiryRecipient;
use App\Models\InquiryRecord;
use App\Models\InquiryType;
use App\Models\MisskeyBatchToken;
use App\Services\ExternalApi\Misskey\MisskeyNoteApi;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class SendInquiryService
{
    public function __construct(
        protected readonly MisskeyNoteApi $noteApi,
    )
    {
    }

    public function getTypeId(): int
    {
        return request()->input('type_id') ??
            InquiryType::getIdFromName(request()->input('type'));
    }

    public function getTypeName(): string
    {
        return request()->input('type') ??
            InquiryType::find(request()->input('type_id'))->name;
    }

    /**
     * 問い合わせの内容をデータベースに保存する.
     * @return InquiryRecord
     */
    public function saveInquiry(?Request $request = null): InquiryRecord
    {
        if (!$request) {
            $request = request();
        }
        $inquiry = new InquiryRecord();
        $inquiry->slug = \Str::uuid();
        $inquiry->name = $request->input('name');
        $inquiry->email = $request->input('email');
        $inquiry->type_id = $this->getTypeId();
        $inquiry->message = $request->input('message');
        $inquiry->ip = get_client_ip();
        $inquiry->user_agent = $request->userAgent();
        $inquiry->save();

        return $inquiry;
    }

    /**
     * Misskey通知を送信するべきかどうか.
     * @return bool
     */
    public function shouldNotifyViaMisskey(): bool
    {
        return (app()->isLocal() || Cache::get(config('const.misskey.availability_key'))) &&
            MisskeyBatchToken::where('for_user', config('const.misskey.notification_account'))
                ->where('is_admin', false)
                ->exists();
    }

    /**
     * Misskey通知を送信する.
     * @param InquiryRecord $inquiry
     * @return bool
     */
    public function sendMisskeyNotification(InquiryRecord $inquiry): bool
    {
        if (!$this->shouldNotifyViaMisskey()) {
            return false;
        }
        $recipientQuery = $inquiry->type->misskey_related ? InquiryRecipient::all() : InquiryRecipient::where('is_admin', true)->get();
        $recipients = $recipientQuery->map(fn($recipient) => $recipient->misskey_id)->toArray();
        $note = [
            'visibility' => 'specified',
            'visibleUserIds' => $recipients,
            'localOnly' => true,
            'text' => "お問い合わせがありました。以下からご確認ください。\n\n" .
                route('staff.inquiry.show', ['slug' => $inquiry->slug]),
        ];

        try {
            $token = MisskeyBatchToken::where('for_user', config('const.misskey.notification_account'))
                ->where('is_admin', false)
                ->firstOrFail()
                ->getDecryptedToken();
            $noteApiResponse = $this->noteApi->createNote($token, $note);
            return array_key_exists('createdNote', $noteApiResponse);
        } catch (Exception $e) {
            Log::warning('Failed to send Misskey notification', ['exception' => $e]);
            return false;
        }
    }
}
