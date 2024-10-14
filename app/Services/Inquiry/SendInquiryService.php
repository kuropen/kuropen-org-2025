<?php

namespace App\Services\Inquiry;

use App\Models\InquiryRecord;
use App\Models\InquiryType;

class SendInquiryService
{
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

    // 問い合わせの内容をデータベースに保存する
    public function saveInquiry(): InquiryRecord
    {
        $inquiry = new InquiryRecord();
        $inquiry->slug = \Str::uuid();
        $inquiry->name = request()->input('name');
        $inquiry->email = request()->input('email');
        $inquiry->type_id = $this->getTypeId();
        $inquiry->message = request()->input('message');
        $inquiry->ip = request()->ip();
        $inquiry->user_agent = request()->userAgent();
        $inquiry->save();

        return $inquiry;
    }
}
