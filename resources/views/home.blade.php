{{--
SPDX-FileCopyrightText: 2024 Kuropen

SPDX-License-Identifier: CC-BY-NC-SA-4.0
--}}

@extends('layouts.main')

@section('content')
    <section>
        <img src="{{ Vite::asset('resources/images/hero_202501.jpg') }}" class="rounded-lg" alt="Fresh Beginnings Ahead" />
    </section>
    <section class="my-4 border border-light-blue-1000 rounded-xl p-4">
        <div class="mb-4">
            <h2><img src="{{ Vite::asset('resources/images/banner_new_sns.png') }}" class="rounded-lg" alt="新しいSNSを推進しています" /></h2>
        </div>
        <nav class="grid grid-cols-2 gap-2">
            <a href="{{route('micropen.how_to_follow')}}" class="border border-gray-800 rounded-lg p-2 flex flex-row gap-2 justify-center">
                <img src="{{ Vite::asset('resources/images/MICROPEN-logo.png') }}" class="w-8 h-8 md:w-12 md:h-12" alt="" />
                <div>
                    <div class="text-sm md:text-lg">MICROPEN <wbr> (Misskey)</div>
                    <div class="hidden md:block">@kuropen@mi.kuropen.org</div>
                </div>
            </a>
            <a href="https://bsky.app/profile/kuropen.org" class="border border-gray-800 rounded-lg p-2 flex flex-row gap-2 justify-center">
                <div class="iconify simple-icons--bluesky w-8 h-8 md:w-12 md:h-12 text-[#0285FF]"></div>
                <div>
                    <div class="text-sm md:text-lg">Bluesky</div>
                    <div class="hidden md:block">@kuropen.org</div>
                </div>
            </a>
            <a href="https://sizu.me/kuropen" class="col-span-2 border border-gray-800 rounded-lg p-2 text-center">
                しずかなインターネット （ブログ）
            </a>
            <a href="{{route('social_policy')}}" class="col-span-2 border border-gray-800 rounded-lg p-2 flex flex-row gap-2 justify-center">
                SNSポリシー
            </a>
            <a href="{{route('planet')}}" class="col-span-2 border border-gray-800 rounded-lg p-2 text-center text-lg">
                最新投稿をまとめて見る
            </a>
        </nav>
        <div x-data="{open: false}" class="border rounded-lg mt-2 p-2">
            <button type="button" class="w-full rounded-lg flex flex-row justify-center">
                <h3
                    class="text-center text-xl"
                    :class="{'underline': !open, 'mb-4': open}"
                    x-on:click="open = true"
                >
                    そのほかのSNS
                </h3>
            </button>
            <div x-show="open">
                <nav class="grid grid-cols-3 gap-2">
                    <a href="https://www.instagram.com/kuropen" class="border border-gray-800 rounded-lg p-2 flex flex-row justify-center">
                        <div class="iconify-color skill-icons--instagram w-8 h-8 md:w-12 md:h-12"></div>
                        <div class="sr-only">Instagram</div>
                    </a>
                    <a href="https://x.com/kuropen_aizu" class="border border-gray-800 rounded-lg p-2 flex flex-row justify-center">
                        <div class="iconify simple-icons--x w-8 h-8 md:w-12 md:h-12"></div>
                        <div class="sr-only">X</div>
                    </a>
                    <a href="https://github.com/kuropen" class="border border-gray-800 rounded-lg p-2 flex flex-row justify-center">
                        <div class="iconify simple-icons--github w-8 h-8 md:w-12 md:h-12"></div>
                        <div class="sr-only">GitHub</div>
                    </a>
                </nav>
                <p class="mt-4 text-sm">
                    ※現在、Xへの投稿はほとんど行っていません。新規のフォローやご連絡はなるべくMisskeyかBlueskyへお願いします。
                </p>
            </div>
        </div>
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
