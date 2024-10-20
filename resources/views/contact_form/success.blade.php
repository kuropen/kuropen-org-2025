<!--
SPDX-FileCopyrightText: 2024 Kuropen

SPDX-License-Identifier: CC-BY-NC-SA-4.0
-->

@extends('layouts.subpage')
@section('page_title', 'お問い合わせフォーム')
@section('content')
    <section>
        <div class="flex flex-row gap-2 bg-green-300 p-4 rounded-lg border">
            <div class="shrink-0">
                <span class="material-symbols-outlined">
                    check_circle
                </span>
            </div>
            <div class="grid grid-cols-1 gap-1">
                <p>お問い合わせを受け付けました。</p>
                <p>お問い合わせ内容によっては、返信にお時間をいただく場合がございます。</p>
                <p>このフォームは問い合わせを行った方に確認メールを送信いたしません。</p>
                <p>MICROPENの不正利用の通報については、その対応を確約するものではありません。</p>
            </div>
        </div>
    </section>
    <section>
        <a href="/" class="border rounded-lg p-2 flex flex-row gap-2 w-fit">
            <span class="material-symbols-outlined">
                chevron_left
            </span>
            <div>
                トップページに戻る
            </div>
        </a>
    </section>
@endsection
