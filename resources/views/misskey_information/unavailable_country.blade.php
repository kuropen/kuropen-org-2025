{{--
SPDX-FileCopyrightText: 2024 Kuropen

SPDX-License-Identifier: CC-BY-NC-SA-4.0
--}}

@extends('layouts.subpage')
@section('page_title', 'MICROPEN')
@section('content')
    <section>
        <h2 class="sr-only">MICROPENが利用できない地域</h2>
        <div class="flex flex-row gap-2 bg-red-300 p-4 rounded-lg border">
            <div class="shrink-0">
                <span class="iconify heroicons--no-symbol w-12 h-12"></span>
            </div>
            <p>
                お使いの端末はMICROPENが利用できない地域に所在しているため、このページは表示できません。<br>
                （個人情報保護法制の問題により、MICROPENは欧州経済領域内および英国からは利用できません）<br>
                （青少年健全育成法制の問題により、MICROPENはオーストラリアからは利用できません）<br>
                また、Tor等の匿名性の高いネットワークからの利用も禁止しています。
            </p>
        </div>
        <div class="my-4 border border-indigo-700 rounded-xl p-4">
            Kuropenのアカウントにアクセスしたい方は、あなたが所在する地域で利用できる
            ActivityPubをサポートするSNS（Mastodon・Misskey・Pleroma等）のサーバーにご登録いただき、
            お使いのサーバーで <strong>@kuropen@mi.kuropen.org</strong> を検索してください。
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
