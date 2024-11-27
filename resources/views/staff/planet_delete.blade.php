{{--
SPDX-FileCopyrightText: 2024 Kuropen

SPDX-License-Identifier: CC-BY-NC-SA-4.0
--}}

@extends('layouts.subpage')
@section('page_title', 'Planet Penguinone コンテンツ削除')
@section('content')
    <section>
        <h2 class="text-2xl mb-4 border-b border-b-gray-300">管理画面</h2>
        <h3 class="text-xl mb-2">コンテンツ削除</h3>
        @if($deleteStatus)
            <div class="flex flex-row gap-2 bg-green-300 p-4 rounded-lg border mb-4">
                <div class="shrink-0">
                <span class="material-symbols-outlined">
                    check_circle
                </span>
                </div>
                <div class="grid grid-cols-1 gap-1">
                    <p>削除に成功しました。</p>
                </div>
            </div>
        @endif
        @error('url')
            <div class="flex flex-row gap-2 bg-yellow-200 p-4 rounded-lg border mb-4">
                <div class="shrink-0">
                <span class="material-symbols-outlined">
                    problem
                </span>
                </div>
                <div class="grid grid-cols-1 gap-1">
                    <p>入力内容に不備があります。</p>
                    <ul>
                        <li>{{ $message }}</li>
                    </ul>
                </div>
            </div>
        @enderror
        <form action="{{ route('staff.planet.delete') }}" method="post" class="mb-8">
            @csrf
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label for="url">対象コンテンツのURL</label>
                    <input type="text" name="url" id="url" value="{{old('url')}}" class="w-full border rounded-lg p-2" required>
                </div>
                <button type="submit" class="text-white bg-blue-800 rounded-lg p-2">削除</button>
            </div>
        </form>
        <ul class="flex flex-row gap-4">
            <li><div><a href="{{ route('staff.menu') }}" class="border rounded-lg p-2">メニューへ戻る</a></div></li>
            <li><div><a href="{{ route('staff.logout') }}" class="text-white bg-red-800 rounded-lg p-2">ログアウト</a></div></li>
        </ul>
    </section>
@endsection
