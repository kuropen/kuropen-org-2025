{{--
SPDX-FileCopyrightText: 2024 Kuropen

SPDX-License-Identifier: CC-BY-NC-SA-4.0
--}}

@extends('layouts.subpage')
@section('page_title', 'MICROPEN ブロック先詳細入力')
@section('content')
    <section>
        <h2 class="text-2xl mb-4 border-b border-b-gray-300">管理画面</h2>
        <h3 class="text-xl mb-2">MICROPEN ブロック先詳細入力</h3>
        @if($status)
            <div class="flex flex-row gap-2 bg-green-200 p-4 rounded-lg border mb-4">
                <div class="shrink-0">
                    <span class="iconify heroicons--check-circle w-12 h-12"></span>
                </div>
                <div class="grid grid-cols-1 gap-1">
                    <p>設定に成功しました。</p>
                </div>
            </div>
        @endif
        @error('url')
            <div class="flex flex-row gap-2 bg-yellow-200 p-4 rounded-lg border mb-4">
                <div class="shrink-0">
                    <span class="iconify heroicons--exclamation-circle w-12 h-12"></span>
                </div>
                <div class="grid grid-cols-1 gap-1">
                    <p>入力内容に不備があります。</p>
                    <ul>
                        <li>{{ $message }}</li>
                    </ul>
                </div>
            </div>
        @enderror
        <form action="{{ route('staff.set_block_description.execute') }}" method="post" class="mb-8">
            @csrf
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label for="serverId">対象サーバー</label>
                    <select name="serverId" id="serverId" class="w-full border rounded-lg p-2">
                        @foreach($servers as $server)
                            <option value="{{ $server->id }}" {{ old('serverId') == $server->id ? 'selected' : '' }}>{{ $server->hostname }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="description">ブロック理由等の説明</label>
                    <input type="text" name="description" id="description" value="{{ old('description') }}" class="w-full border rounded-lg p-2" required>
                </div>
                <button type="submit" class="text-white bg-blue-800 rounded-lg p-2">設定</button>
            </div>
        </form>
        <ul class="flex flex-row gap-4">
            <li><div><a href="{{ route('staff.menu') }}" class="border rounded-lg p-2">メニューへ戻る</a></div></li>
            <li><div><a href="{{ route('staff.logout') }}" class="text-white bg-red-800 rounded-lg p-2">ログアウト</a></div></li>
        </ul>
    </section>
@endsection
