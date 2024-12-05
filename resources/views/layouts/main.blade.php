{{--
SPDX-FileCopyrightText: 2024 Kuropen

SPDX-License-Identifier: CC-BY-NC-SA-4.0
--}}
@extends('layouts.skelton')
@section('body')
<div class="max-w-[896px] mx-auto my-12 px-7 md:px-10 flex flex-col gap-12">
    <header class="flex flex-col md:flex-row items-center md:items-start gap-3">
        <a href="/" class="md:flex-grow">
            <div class="flex flex-row gap-3">
                <img src="{{ Vite::asset('resources/images/penguin.png') }}" alt="" class="w-10 h-10 rounded-full">
                <h1 class="text-2xl inter">{{config('app.name')}}</h1>
            </div>
        </a>
    </header>
    @if($cookiePolicyConfirmationRequired)
        <x-cookie-policy />
    @endif
    @yield('content')
    <footer>
        <address class="not-italic">
            Copyright (C) {{date('Y')}} Kuropen.
        </address>
        <div class="flex flex-col md:flex-row gap-2 md:gap-4">
            <a href="{{ route('about') }}" class="text-blue-1000">サイト情報・著作権について</a>
            <a href="{{ route('legal') }}" class="text-blue-1000">プライバシーポリシー</a>
        </div>
    </footer>
</div>
@endsection
