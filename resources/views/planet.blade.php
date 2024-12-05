{{--
SPDX-FileCopyrightText: 2024 Kuropen

SPDX-License-Identifier: CC-BY-NC-SA-4.0
--}}

@extends('layouts.subpage')
@section('page_title', 'Planet Penguinone')
@section('content')
    <div class="rounded-lg p-4 border">
        <div class="mb-4">
            <h2 class="text-2xl">Planet Penguinone</h2>
            <p>Kuropenのソーシャルメディアやブログなどの更新タイムラインです。</p>
            <p>Inspired by <a href="https://www.eniehack.net/~eniehack/planet/" class="text-blue-1000">planet eniehack</a></p>
        </div>
        <hr>
        <h3 class="text-xl my-4">Datasources</h3>
        <ul>
            <li class="flex flex-row gap-2 border-b mb-2">
                <span class="iconify heroicons--rss w-6 h-6"></span>
                <a href="https://sizu.me/kuropen">しずかなインターネット</a>
            </li>
            <li class="flex flex-row gap-2 border-b mb-2">
                <div class="iconify simple-icons--notion w-6 h-6"></div>
                <a href="https://penguinone.notion.site/cc3b0e9ccab34bbf95c2bec97dc1e673">雑記帳過去記事</a>
            </li>
            <li class="flex flex-row gap-2 border-b mb-2">
                <div class="w-6 h-6">
                    <img src="{{ Vite::asset('resources/images/MICROPEN-logo.png') }}" alt="">
                </div>
                <a href="{{route('micropen.index')}}">MICROPEN</a>
            </li>
            <li class="flex flex-row gap-2 border-b mb-2">
                <div class="iconify simple-icons--bluesky w-6 h-6 text-[#0285FF]"></div>
                <a href="https://bsky.app/profile/kuropen.org">Bluesky</a>
            </li>
        </ul>
        <p class="my-4">
            @isset($lastRunLog)最終取得: {{ \Carbon\Carbon::make($lastRunLog->run_date)->timezone('Asia/Tokyo')->format('Y/m/d H:i') }}<br>@endisset
            30分に1回取得します。MICROPENは取得時刻10分前以降の投稿は表示されません。
        </p>
    </div>
    <div class="rounded-lg p-4 border">
        @php($previousPublishedDate = null)
        @foreach($documents as $document)
            @if($previousPublishedDate !== ($publishedDate = \Carbon\Carbon::make($document->published_at)->timezone('Asia/Tokyo')->format('Y/m/d')))
                <h3 class="text-xl mb-4">{{$publishedDate}}</h3>
                @php($previousPublishedDate = $publishedDate)
            @endif
            <div class="border-b mb-4">
                <div class="flex flex-row align-middle gap-2">
                    <div>
                        @if($document->data_source === 'misskey')
                            <div class="w-6 h-6">
                                <img src="{{ Vite::asset('resources/images/MICROPEN-logo.png') }}" alt="">
                            </div>
                        @elseif($document->data_source === 'bluesky')
                            <div class="w-6 h-6 stroke-[#0285FF] fill-[#0285FF]">
                                <svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 10.8c-1.087-2.114-4.046-6.053-6.798-7.995C2.566.944 1.561 1.266.902 1.565.139 1.908 0 3.08 0 3.768c0 .69.378 5.65.624 6.479.815 2.736 3.713 3.66 6.383 3.364.136-.02.275-.039.415-.056-.138.022-.276.04-.415.056-3.912.58-7.387 2.005-2.83 7.078 5.013 5.19 6.87-1.113 7.823-4.308.953 3.195 2.05 9.271 7.733 4.308 4.267-4.308 1.172-6.498-2.74-7.078a8.741 8.741 0 0 1-.415-.056c.14.017.279.036.415.056 2.67.297 5.568-.628 6.383-3.364.246-.828.624-5.79.624-6.478 0-.69-.139-1.861-.902-2.206-.659-.298-1.664-.62-4.3 1.24C16.046 4.748 13.087 8.687 12 10.8Z"/></svg>
                            </div>
                        @elseif(str_starts_with($document->url, 'https://sizu.me/kuropen'))
                            <span class="iconify heroicons--rss w-6 h-6"></span>
                        @elseif(str_contains($document->url, 'notion.so'))
                            <div class="w-6 h-6">
                                <svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M4.459 4.208c.746.606 1.026.56 2.428.466l13.215-.793c.28 0 .047-.28-.046-.326L17.86 1.968c-.42-.326-.981-.7-2.055-.607L3.01 2.295c-.466.046-.56.28-.374.466zm.793 3.08v13.904c0 .747.373 1.027 1.214.98l14.523-.84c.841-.046.935-.56.935-1.167V6.354c0-.606-.233-.933-.748-.887l-15.177.887c-.56.047-.747.327-.747.933zm14.337.745c.093.42 0 .84-.42.888l-.7.14v10.264c-.608.327-1.168.514-1.635.514-.748 0-.935-.234-1.495-.933l-4.577-7.186v6.952L12.21 19s0 .84-1.168.84l-3.222.186c-.093-.186 0-.653.327-.746l.84-.233V9.854L7.822 9.76c-.094-.42.14-1.026.793-1.073l3.456-.233 4.764 7.279v-6.44l-1.215-.139c-.093-.514.28-.887.747-.933zM1.936 1.035l13.31-.98c1.634-.14 2.055-.047 3.082.7l4.249 2.986c.7.513.934.653.934 1.213v16.378c0 1.026-.373 1.634-1.68 1.726l-15.458.934c-.98.047-1.448-.093-1.962-.747l-3.129-4.06c-.56-.747-.793-1.306-.793-1.96V2.667c0-.839.374-1.54 1.447-1.632z"/></svg>
                            </div>
                        @endif
                    </div>
                    <div class="flex-grow break-all">
                        {{ $document->title }}
                        (<a href="{{ $document->url }}" target="_blank" class="text-blue-1000">{{ \Carbon\Carbon::make($document->published_at)->timezone('Asia/Tokyo')->format('H:i') }}</a>)
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <section>
        <a href="/" class="border rounded-lg p-2 flex flex-row gap-2 w-fit">
            <span class="iconify heroicons--chevron-left w-6 h-6"></span>
            <div>
                トップページに戻る
            </div>
        </a>
    </section>
@endsection
