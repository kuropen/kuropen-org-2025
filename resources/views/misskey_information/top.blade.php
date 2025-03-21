{{--
SPDX-FileCopyrightText: 2024 Kuropen

SPDX-License-Identifier: CC-BY-NC-SA-4.0
--}}

@extends('layouts.subpage')
@section('page_title', 'MICROPEN information')
@section('content')
    <section class="my-4 border border-light-blue-1000 rounded-xl p-4">
        <div class="flex flex-row gap-2 justify-center">
            <img src="{{ Vite::asset('resources/images/MICROPEN-logo.png') }}" alt="" class="w-8 h-8">
            <h2 class="text-xl mb-2">MICROPEN Information</h2>
        </div>
        <div class="border rounded-lg p-2 my-4">
            MICROPENは分散型SNS Misskeyのサーバーです。現在完全招待制で運用しています。<br />
            なお、招待コードの発行をご希望の方は、<a href="{{route('contact')}}" class="underline">お問い合わせ</a>ください。
        </div>
        <ul>
            <li class="border-b mb-2">
                <a href="https://mi.kuropen.org/" class="flex flex-row align-middle">
                    <div class="flex-grow">
                        MICROPENログインページ
                    </div>
                    <div>
                        <span class="iconify heroicons--chevron-right w-6 h-6"></span>
                    </div>
                </a>
            </li>
            <li class="border-b mb-2">
                <a href="{{route('micropen.how_to_follow')}}" class="flex flex-row align-middle">
                    <div class="flex-grow">
                        Kuropenのアカウントへのアクセス・フォロー
                    </div>
                    <div>
                        <span class="iconify heroicons--chevron-right w-6 h-6"></span>
                    </div>
                </a>
            </li>
            <li class="border-b mb-2">
                <a href="{{route('micropen.terms')}}" class="flex flex-row align-middle">
                    <div class="flex-grow">
                        利用規約
                    </div>
                    <div>
                        <span class="iconify heroicons--chevron-right w-6 h-6"></span>
                    </div>
                </a>
            </li>
            <li class="border-b mb-2">
                <a href="{{route('micropen.blocked')}}" class="flex flex-row align-middle">
                    <div class="flex-grow">
                        ブロックしているサーバー
                    </div>
                    <div>
                        <span class="iconify heroicons--chevron-right w-6 h-6"></span>
                    </div>
                </a>
            </li>
            <li class="border-b mb-2">
                <a href="{{route('statement_fediverse_spam')}}" class="flex flex-row align-middle">
                    <div class="flex-grow">
                        2024年2月のFediverseスパム攻撃へのMICROPENの対応
                    </div>
                    <div>
                        <span class="iconify heroicons--chevron-right w-6 h-6"></span>
                    </div>
                </a>
            </li>
        </ul>
        <nav class="grid grid-cols-2 gap-2">
            <a href="https://status.kuropen.org/" class="border rounded-lg p-2">
                障害・メンテナンス情報
            </a>
            <a href="{{route('contact')}}" class="border rounded-lg p-2">
                お問い合わせ
            </a>
        </nav>
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
