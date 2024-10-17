<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendInquiryRequest;
use App\Mail\InquiryMail;
use App\Models\InquiryType;
use App\Services\Inquiry\SendInquiryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactFormController extends Controller
{
    public function show(Request $request)
    {
        $givenTypeId = old('type_id') ?? $request->query('type');
        $types = InquiryType::all();
        return view('contact_form.contact_form', compact('types', 'givenTypeId'));
    }

    public function submit(SendInquiryRequest $request, SendInquiryService $service)
    {
        // 問い合わせ内容をデータベースに保存
        $inquiry = $service->saveInquiry($request);

        // Misskey通知を送信し、失敗したら問い合わせメールを送信
        if (!$service->sendMisskeyNotification($inquiry)) {
            Mail::send(new InquiryMail($inquiry));
        }

        return view('contact_form.success');
    }
}
