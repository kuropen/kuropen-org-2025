{{--
SPDX-FileCopyrightText: 2024 Kuropen

SPDX-License-Identifier: CC-BY-NC-SA-4.0
--}}

@extends('layouts.main')

@section('content')
    <section class="my-4 border border-light-blue-1000 rounded-xl p-4">
        <div class="flex flex-row gap-2 justify-center">
            <span class="iconify heroicons--user-circle w-8 h-8"></span>
            <h2 class="text-xl mb-2">Find Me On...</h2>
        </div>
        <nav class="grid grid-cols-4 gap-4">
            <a href="{{route('micropen.how_to_follow')}}" class="col-span-2 border border-gray-800 rounded-lg p-2 flex flex-row gap-2 justify-center">
                <img src="{{ Vite::asset('resources/images/MICROPEN-logo.png') }}" class="w-8 h-8 md:w-12 md:h-12" alt="" />
                <div>
                    <div class="text-sm md:text-lg">MICROPEN <wbr> (Misskey)</div>
                    <div class="hidden md:block">@kuropen@mi.kuropen.org</div>
                </div>
            </a>
            <a href="https://bsky.app/profile/kuropen.org" class="col-span-2 border border-gray-800 rounded-lg p-2 flex flex-row gap-2 justify-center">
                <div class="iconify simple-icons--bluesky w-8 h-8 md:w-12 md:h-12 text-[#0285FF]"></div>
                <div>
                    <div class="text-sm md:text-lg">Bluesky</div>
                    <div class="hidden md:block">@kuropen.org</div>
                </div>
            </a>
            <a href="https://x.com/kuropen_aizu" class="border border-gray-800 rounded-lg p-2 flex flex-row justify-center">
                <div class="iconify simple-icons--x w-8 h-8 md:w-12 md:h-12"></div>
                <div class="sr-only">X</div>
            </a>
            <a href="https://www.instagram.com/kuropen" class="border border-gray-800 rounded-lg p-2 flex flex-row justify-center">
                <div class="iconify-color skill-icons--instagram w-8 h-8 md:w-12 md:h-12"></div>
                <div class="sr-only">Instagram</div>
            </a>
            <a href="https://www.threads.net/kuropen" class="border border-gray-800 rounded-lg p-2 flex flex-row justify-center">
                <div class="iconify simple-icons--threads w-8 h-8 md:w-12 md:h-12"></div>
                <div class="sr-only">Threads</div>
            </a>
            <a href="https://github.com/kuropen" class="border border-gray-800 rounded-lg p-2 flex flex-row justify-center">
                <div class="iconify simple-icons--github w-8 h-8 md:w-12 md:h-12"></div>
                <div class="sr-only">GitHub</div>
            </a>
            <a href="https://nostx.io/npub1r04snmtpkg36wn9220f358rymyvul5ew37fnhj5cqlwaf20ywrqqnmgg0k" class="col-span-2 border border-gray-800 rounded-lg p-2 flex flex-row gap-2 justify-center">
                Nostr
            </a>
            <a href="{{route('social_policy')}}" class="col-span-2 border border-gray-800 rounded-lg p-2 flex flex-row gap-2 justify-center">
                SNSポリシー
            </a>
            <a href="https://sizu.me/kuropen" class="col-span-2 border border-gray-800 rounded-lg p-2 text-center">
                しずかなインターネット
            </a>
            <a href="https://penguinone.notion.site/cc3b0e9ccab34bbf95c2bec97dc1e673" class="col-span-2 border border-gray-800 rounded-lg p-2 text-center">
                雑記帳過去記事 <small>(2023年10月まで)</small>
            </a>
            <a href="{{route('planet')}}" class="col-span-4 border border-gray-800 rounded-lg p-2 text-center text-lg">
                Planet Penguinone (統合タイムライン)
            </a>
        </nav>
    </section>
    <section class="my-4 border border-light-blue-1000 rounded-xl p-4">
        <div class="flex flex-row gap-2 justify-center">
            <span class="iconify heroicons--code-bracket-square w-8 h-8"></span>
            <h2 class="text-xl mb-2">Works</h2>
        </div>
        <ul>
            <li class="border-b mb-2">
                <a href="{{route('micropen.index')}}" class="flex flex-row align-middle">
                    <div class="flex-grow">
                        MICROPEN (Misskey Server)
                    </div>
                    <div>
                        <span class="iconify heroicons--chevron-right w-6 h-6"></span>
                    </div>
                </a>
            </li>
            <li class="border-b mb-2">
                <a href="https://akabe.co" class="flex flex-row align-middle">
                    <div class="flex-grow">
                        Gain the Power from Akabeko
                    </div>
                    <div>
                        <span class="iconify heroicons--chevron-right w-6 h-6"></span>
                    </div>
                </a>
            </li>
        </ul>
        <nav class="grid grid-cols-2 gap-2">
            <a href="https://status.kuropen.org/" class="border border-gray-800 rounded-lg p-2">
                障害・メンテナンス情報
            </a>
            <a href="{{route('contact')}}" class="border border-gray-800 rounded-lg p-2">
                お問い合わせ
            </a>
        </nav>
    </section>
    <section class="flex flex-row justify-center">
        <a href="/staff-zone" class="border rounded-lg p-2">
            管理画面ログイン
        </a>
    </section>
@endsection
