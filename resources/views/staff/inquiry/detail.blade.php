{{--
SPDX-FileCopyrightText: 2024 Kuropen

SPDX-License-Identifier: CC-BY-NC-SA-4.0
--}}

@extends('layouts.subpage')
@section('page_title', '問い合わせ内容')
@section('content')
    <section>
        <h2 class="text-2xl mb-4 border-b border-b-gray-300">管理画面</h2>
        <h3 class="text-xl mb-2">問い合わせ内容確認</h3>
        <ul class="mb-4">
            <li>送信日時: {{$inquiry->created_at->timezone('Asia/Tokyo')->format('Y年m月d日 H:i:s')}}</li>
            <li>お名前: {{$inquiry->name}}</li>
            <li>メールアドレス: <a href="mailto:{{$inquiry->email}}">{{$inquiry->email}}</a></li>
            @if($inquiry->ip)
                <li>IPアドレス: {{$inquiry->ip}}</li>
            @endif
            @if($inquiry->user_agent)
                <li>User-Agent: {{$inquiry->user_agent}}</li>
            @endif
            <li>お問い合わせ種別: {{$inquiry->type->name}}</li>
            <li>お問い合わせ内容: {{$inquiry->message}}</li>
        </ul>
        <ul class="flex flex-row gap-4">
            <li><div><a href="{{ route('staff.inquiry.list') }}" class="border rounded-lg p-2">一覧へ戻る</a></div></li>
            <li><div><a href="{{ URL::signedRoute('staff.inquiry.delete', ['slug' => $inquiry->slug]) }}" class="text-white bg-red-800 rounded-lg p-2">削除</a></div></li>
            <li><div><a href="{{ route('staff.logout') }}" class="text-white bg-red-800 rounded-lg p-2">ログアウト</a></div></li>
        </ul>
    </section>
@endsection
