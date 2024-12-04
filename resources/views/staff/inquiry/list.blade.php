{{--
SPDX-FileCopyrightText: 2024 Kuropen

SPDX-License-Identifier: CC-BY-NC-SA-4.0
--}}

@extends('layouts.subpage')
@section('page_title', '問い合わせ一覧')
@section('content')
    <section>
        <h2 class="text-2xl mb-4 border-b border-b-gray-300">管理画面</h2>
        <h3 class="text-xl mb-2">問い合わせ内容一覧</h3>
        @if($deleteStatus)
            <div class="flex flex-row gap-2 bg-green-300 p-4 rounded-lg border">
                <div class="shrink-0">
                    <span class="iconify heroicons--check-circle w-12 h-12"></span>
                </div>
                <div class="grid grid-cols-1 gap-1">
                    <p>削除に成功しました。</p>
                </div>
            </div>
        @endif
        <ul class="mb-4">
            @foreach($inquiries as $inquiry)
                <li class="my-1 grid grid-cols-2 md:flex md:flex-row p-2 gap-2 border-b">
                    <div class="col-span-2 md:flex-grow">
                        {{$inquiry->created_at->timezone('Asia/Tokyo')->format('Y年m月d日 H:i:s')}}
                    </div>
                    <a href="{{ route('staff.inquiry.show', ['slug' => $inquiry->slug]) }}" class="border rounded-lg p-2 text-center">
                        表示
                    </a>
                    <a href="{{ URL::signedRoute('staff.inquiry.delete', ['slug' => $inquiry->slug]) }}" class="text-white bg-red-800 rounded-lg p-2 text-center">
                        削除
                    </a>
                </li>
            @endforeach
        </ul>
        <ul class="flex flex-row gap-4">
            <li><a href="{{ route('staff.menu') }}" class="border rounded-lg p-2">メニューへ戻る</a></li>
            <li><a href="{{ route('staff.logout') }}" class="text-white bg-red-800 rounded-lg p-2">ログアウト</a></li>
        </ul>
    </section>
@endsection
