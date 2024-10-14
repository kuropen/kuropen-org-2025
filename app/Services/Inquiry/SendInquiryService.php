<?php

namespace App\Services\Inquiry;

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
}
