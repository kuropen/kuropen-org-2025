<!doctype html>
<html lang="{{config('app.locale')}}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('page_title')@yield('title_separator'){{config('app.name')}}</title>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="me" href="https://mi.kuropen.org/@kuropen">
    <link rel="me" href="https://fedibird.com/@kuropen">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <meta name="og:site_name" content="{{config('app.name')}}">
    <meta name="og:title" content="@yield('page_title')@yield('title_separator'){{config('app.name')}}">
    <meta name="og:description" content="{{config('const.site_description')}}">
    <meta name="og:type" content="website">
    <meta name="og:url" content="{{url()->current()}}">
    @vite('resources/css/app.css')
</head>
<body>
<div class="max-w-[896px] mx-auto my-12 px-7 md:px-10 flex flex-col gap-12">
    <header class="flex flex-col md:flex-row items-center md:items-start gap-3">
        <a href="/" class="md:flex-grow">
            <div class="flex flex-row gap-3">
                <img src="/images/penguin.png" alt="" class="w-10 h-10 rounded-full">
                <h1 class="text-2xl inter">{{config('app.name')}}</h1>
            </div>
        </a>
    </header>
    @if($cookiePolicyConfirmationRequired)
        <aside class="flex flex-col gap-2 md:flex-row border border-orange-400 rounded-lg p-2" x-data="cookiePolicy" x-show="show">
            <div class="md:flex-grow flex flex-col gap-1">
                <h2 class="font-bold">
                    電気通信事業法に基づく表示
                </h2>
                <p>
                    このサイトで利用するCookie、このサイトを利用することによって外部事業者に送信される情報などの詳細は、以下をご覧ください。<br>
                    <a href="{{route('legal')}}" class="text-blue-800">
                        プライバシーポリシー <br class="md:hidden">
                        (最終更新 {{\Illuminate\Support\Carbon::make((new DateTime())->setTimestamp($cookiePolicyLastModified))->format('Y年m月d日')}})
                    </a>
                </p>
                <p class="text-sm">「確認」ボタンを押すと、以後プライバシーポリシーが更新されるまでこのメッセージは表示されません。</p>
            </div>
            <button
                type="button"
                id="cookie-policy-confirmation-button"
                class="border rounded-lg py-2 px-6 bg-blue-800 text-white shrink-0"
                x-on:click="confirmPolicy"
            >
                確認
            </button>
        </aside>
    @endif
    @yield('content')
    <footer>
        <address class="not-italic">
            All rights reserved. Copyright (C) {{date('Y')}} Kuropen.
        </address>
        <div>
            <a href="{{ route('legal') }}" class="text-blue-800">プライバシーポリシー</a>
        </div>
    </footer>
</div>
@vite('resources/js/app.ts')
</body>
</html>
