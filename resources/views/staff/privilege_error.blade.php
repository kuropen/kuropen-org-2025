{{--
SPDX-FileCopyrightText: 2024 Kuropen

SPDX-License-Identifier: CC-BY-NC-SA-4.0
--}}

@extends('layouts.subpage')
@section('page_title', '管理画面 権限エラー')
@section('content')
    <section>
        <h2 class="text-2xl mb-2">管理画面</h2>
        <p class="bg-red-800 text-white rounded-lg p-2">
            権限がないユーザーでログインしています。
            <a href="{{ route('staff.logout') }}" class="underline">ログアウト</a>してください。
        </p>
    </section>
@endsection
