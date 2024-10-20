<!--
SPDX-FileCopyrightText: 2024 Kuropen

SPDX-License-Identifier: CC-BY-NC-SA-4.0
-->

@extends('layouts.subpage')
@section('page_title', 'How to Follow')
@section('content')
    <section class="flex flex-col gap-4 my-4 border border-indigo-700 rounded-xl p-4">
        <h2 class="text-xl mb-2">KuropenのMisskeyアカウントにアクセスする</h2>
        <p>
            Kuropenのアカウントは自営のMisskeyサーバーであるMICROPENにあります。<br>
            MICROPENの画面で直接投稿を見る方は以下のボタンを押してください。
        </p>
        <a href="https://mi.kuropen.org/@kuropen" class="block bg-blue-800 text-white text-center rounded-xl p-4">
            フォローせずにKuropenの投稿を表示する
        </a>
    </section>
    <section
        class="flex flex-col gap-4 my-4 border border-indigo-700 rounded-xl p-4"
        x-data="{activeTab: '', init() {this.activeTab = 'Misskey'}}"
    >
        <h2 class="text-xl mb-2">KuropenのMisskeyアカウントをフォローするには</h2>
        <p>
            お使いのサーバーで <strong>@kuropen@mi.kuropen.org</strong> を検索するとフォローすることができます。
        </p>
        <div class="border rounded-xl p-4 flex flex-col gap-4">
            <ul class="grid grid-cols-2 gap-3" role="tablist">
                <li role="tab"
                    class="border-b-4 text-center"
                    :class="{'border-green-400': activeTab === 'Misskey'}"
                    :aria-selected="activeTab === 'Misskey'"
                    x-on:click="activeTab = 'Misskey'">
                    Misskey
                </li>
                <li role="tab"
                    class="border-b-4 text-center"
                    :class="{'border-green-400': activeTab === 'Mastodon'}"
                    :aria-selected="activeTab === 'Mastodon'"
                    x-on:click="activeTab = 'Mastodon'">
                    Mastodon
                </li>
            </ul>
            <div x-show="activeTab === 'Misskey'">
                <h3 class="sr-only">Misskeyの場合</h3>
                <div class="flex flex-col md:flex-row gap-4">
                    <p>
                        <img src="/images/follow_misskey_1.png" alt="Misskeyの場合のフォロー手順">
                    </p>
                    <ol class="list-decimal pl-4">
                        <li>メニューの「もっと！」→「照会」をクリックします。</li>
                        <li>表示された画面で <strong>@kuropen@mi.kuropen.org</strong> と入力します。</li>
                    </ol>
                </div>
            </div>
            <div x-show="activeTab === 'Mastodon'">
                <h3 class="sr-only">Mastodonの場合</h3>
                <div class="flex flex-col md:flex-row gap-4">
                    <p>
                        <img src="/images/follow_mastodon_1.png" alt="Mastodonの場合のフォロー手順">
                    </p>
                    <p>
                        画面の検索ボックスに <strong>@kuropen@mi.kuropen.org</strong> と入力します。
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="flex flex-col md:flex-row gap-4">
        <a href="/" class="border rounded-lg p-2 flex flex-row gap-2 w-fit">
            <span class="material-symbols-outlined">
                chevron_left
            </span>
            <div>
                トップページに戻る
            </div>
        </a>
        <a href="{{route('micropen.index')}}" class="border rounded-lg p-2 flex flex-row gap-2 w-fit">
            <span class="material-symbols-outlined">
                chevron_left
            </span>
            <div>
                MICROPEN情報に戻る
            </div>
        </a>
    </section>
@endsection
