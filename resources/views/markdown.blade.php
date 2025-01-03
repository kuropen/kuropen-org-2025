{{--
SPDX-FileCopyrightText: 2024 Kuropen

SPDX-License-Identifier: CC-BY-NC-SA-4.0
--}}

@extends('layouts.subpage')
@section('page_title', $title)
@section('content')
    <section class="my-4 mx-auto">
        <div class="prose rounded-lg p-4 border">
            {!! $content !!}
        </div>
    </section>
    <section>
        <a href="{{$backTo['url']}}" class="border rounded-lg p-2 flex flex-row gap-2 w-fit">
            <span class="iconify heroicons--chevron-left w-6 h-6"></span>
            <div>
                {{$backTo['title']}}に戻る
            </div>
        </a>
    </section>
@endsection
