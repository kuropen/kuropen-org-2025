{{--
SPDX-FileCopyrightText: 2024 Kuropen

SPDX-License-Identifier: CC-BY-NC-SA-4.0
--}}

@extends('layouts.skeleton')
@section('body')
    <main class="max-w-[896px] mx-auto flex flex-col gap-12 mt-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <header class="mx-auto my-4 h-12 gap-3">
                <a href="/">
                    <div class="flex flex-row gap-3">
                        <img src="{{ Vite::asset('resources/images/penguin.png') }}" alt="" class="w-10 h-10 rounded-full">
                        <h1 class="text-2xl inter">{{config('app.name')}}</h1>
                    </div>
                </a>
            </header>
            <aside class="md:order-first md:row-span-2">
                <img src="{{ Vite::asset('resources/images/hero_20250318.jpg') }}" class="rounded" alt="">
            </aside>
            <nav>
                <ul class="flex flex-col gap-2">
                    <li class="text-xl text-center"><a href="{{ route('micropen.how_to_follow') }}" class="link-text">Misskey</a></li>
                    <li class="text-xl text-center"><a href="https://bsky.app/profile/kuropen.org" class="link-text" target="_blank">Bluesky</a></li>
                    <li class="text-xl text-center"><a href="https://sizu.me/kuropen" class="link-text" target="_blank">Blog</a></li>
                    <li class="text-xl text-center"><a href="{{ route('planet') }}" class="link-text">Timeline</a></li>
                    <li class="text-xl text-center"><a href="{{ route('works') }}" class="link-text">Works</a></li>
                    <li class="text-xl text-center"><a href="{{ route('contact') }}" class="link-text">Contact</a></li>
                    <li class="mt-4 text-base text-center"><a href="{{ route('micropen.index') }}" class="link-text">Misskey Server Info</a></li>
                    <li class="text-base text-center"><a href="/staff-zone" class="link-text">Staff Zone</a></li>
                </ul>
            </nav>
        </div>
        <x-footer />
    </main>
    @if($cookiePolicyConfirmationRequired)
        <x-cookie-policy/>
    @endif
@endsection
