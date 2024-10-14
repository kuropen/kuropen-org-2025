<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendInquiryRequest;
use App\Mail\InquiryMail;
use App\Models\InquiryType;
use App\Services\Inquiry\SendInquiryService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class InquiryApiController extends Controller
{
    public function getToken()
    {
        // タイムスタンプを取得
        $timestamp = time();

        // UUID v4でトークンを生成
        $token = \Ramsey\Uuid\Uuid::uuid4()->toString();

        // トークンをキャッシュに保存。有効期限は1時間
        Cache::put("token_{$timestamp}", $token, 60 * 60);

        // トークンとタイムスタンプをJSON形式で返却
        return response()->json([
            'token' => $token,
            'timestamp' => $timestamp
        ])->header('Cache-Control', 'private, max-age=60, stale-while-revalidate=3600, stale-if-error=3600, must-revalidate');
    }

    public function getTypes()
    {
        $types = InquiryType::select(['id', 'name', 'description', 'valid'])->orderBy('id')->get();
        return response()->json([
            'types' => $types
        ])->header('Cache-Control', 'public, max-age=3600, must-revalidate');
    }

    public function send(SendInquiryRequest $request, SendInquiryService $service)
    {
        // 問い合わせ内容をデータベースに保存
        $inquiry = $service->saveInquiry();

        // お問い合わせメールを送信
        Mail::send(new InquiryMail($inquiry));

        // トークンを削除
        list($timestamp) = $request->extractToken();
        Cache::forget("token_{$timestamp}");

        return response()->json([
            'message' => 'メールを送信しました'
        ]);
    }
}
