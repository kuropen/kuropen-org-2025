<!--
SPDX-FileCopyrightText: 2024 Kuropen

SPDX-License-Identifier: CC-BY-NC-SA-4.0
-->

@extends('layouts.subpage')
@section('page_title', '管理画面')
@section('content')
    <section>
        <h2 class="text-2xl">管理画面</h2>
        <ul>
            <li>ユーザー名: {{$userName}}</li>
            <li>権限: {{$privilege}}</li>
        </ul>
        <ul class="flex flex-col gap-4 my-4">
            <li><a href="{{ route('staff.inquiry.list') }}" class="border rounded-lg p-2">問い合わせ内容確認</a></li>
            <li><a href="{{ route('staff.logout') }}" class="text-white bg-red-800 rounded-lg p-2">ログアウト</a></li>
        </ul>
    </section>
@endsection
