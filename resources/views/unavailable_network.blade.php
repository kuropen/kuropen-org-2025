{{--
SPDX-FileCopyrightText: 2024 Kuropen

SPDX-License-Identifier: CC-BY-NC-SA-4.0
--}}

@extends('layouts.subpage')
@section('page_title', '利用が制限されているネットワーク')
@section('content')
    <section>
        <h2 class="sr-only">MICROPENの一部機能が制限されているネットワーク</h2>
        <div class="flex flex-row gap-2 bg-red-300 p-4 rounded-lg border">
            <div class="shrink-0">
                <span class="iconify heroicons--no-symbol w-12 h-12"></span>
            </div>
            <p>
                お使いの端末はTor等の匿名性の高いネットワークから接続しているため、
                このページの一部機能が制限されています。
            </p>
        </div>
    </section>
    <section>
        <a href="/" class="border rounded-lg p-2 flex flex-row gap-2 w-fit">
            <span class="iconify heroicons--chevron-left w-6 h-6"></span>
            <div>
                トップページに戻る
            </div>
        </a>
    </section>
@endsection
