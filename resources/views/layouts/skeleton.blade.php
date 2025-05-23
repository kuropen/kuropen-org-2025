{{--
SPDX-FileCopyrightText: 2024 Kuropen

SPDX-License-Identifier: CC-BY-NC-SA-4.0
--}}

<!doctype html>
<html lang="{{config('app.locale')}}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('page_title')@yield('title_separator'){{config('app.name')}}</title>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="me" href="https://mi.kuropen.org/@kuropen">
    <link rel="me" href="https://fedibird.com/@kuropen">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <meta property="og:site_name" content="{{config('app.name')}}">
    <meta property="og:title" content="@yield('page_title')@yield('title_separator'){{config('app.name')}}">
    <meta property="og:description" content="{{config('const.site_description')}}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{url()->current()}}">
    @vite('resources/css/app.css')
    @yield('head')
</head>
<body>
@yield('body')
@vite('resources/js/app.ts')
</body>
</html>
