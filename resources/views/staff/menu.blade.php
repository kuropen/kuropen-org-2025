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
            <li>ログインユーザー: {{$userName}} (権限: {{$privilege}})</li>
            <li>システム情報: {{str(app()->environment())->headline()}}, Laravel v{{ Illuminate\Foundation\Application::VERSION }}, PHP v{{ PHP_VERSION }}</li>
        </ul>
        <ul class="flex flex-col gap-4 my-4">
            <li class="border-b mb-2">
                <a href="{{ route('staff.inquiry.list') }}" class="flex flex-row align-middle">
                    <div class="flex-grow">
                        問い合わせ内容確認
                    </div>
                    <div>
                        <span class="material-symbols-outlined">
                            chevron_right
                        </span>
                    </div>
                </a>
            </li>
            <li class="border-b mb-2">
                <a href="{{ route('staff.inquiry.list') }}" class="flex flex-row align-middle">
                    <div class="flex-grow text-red-800">
                        ログアウト
                    </div>
                    <div>
                        <span class="material-symbols-outlined">
                            chevron_right
                        </span>
                    </div>
                </a>
            </li>
        </ul>
    </section>
@endsection
