{{--
SPDX-FileCopyrightText: 2024 Kuropen

SPDX-License-Identifier: CC-BY-NC-SA-4.0
--}}

@extends('layouts.subpage')
@section('page_title', 'MICROPENからブロックされているサーバー')
@section('content')
    <section>
        <h2 class="text-xl mb-2">MICROPENからブロックされているサーバー</h2>
        <p class="mb-2">以下のサーバーは当サーバーからブロックされています。</p>

        <div class="m-4">
            <ul class="flex flex-row gap-4 justify-center" role="tablist">
                <li role="tab">
                    <a href="{{route('micropen.blocked', ['repealed' => false])}}" class="m-2 p-2 border-b-4 text-center @unless($showRepealed) border-green-400 @endunless">
                        ブロック実施中
                    </a>
                </li>
                <li role="tab">
                    <a href="{{route('micropen.blocked', ['repealed' => true])}}" class="m-2 p-2 border-b-4 text-center @if($showRepealed) border-green-400 @endif">
                        解除済み
                    </a>
                </li>
            </ul>
        </div>

        @empty($blockedList)
            <p class="border rounded-lg p-4">表示対象のサーバーはありません。</p>
        @else
            <table class="mx-auto table-auto">
                <tr class="border">
                    <th>ホスト名</th>
                    @if($showRepealed)
                        <th>ブロック解除日</th>
                    @else
                        <th>ブロック実施日</th>
                        <th>詳細</th>
                    @endif
                </tr>
                @foreach($blockedList as $blocked)
                    <tr class="border">
                        <td>{{$blocked->hostname}}</td>
                        @if($showRepealed)
                            <td class="pl-2">
                                {{\Illuminate\Support\Carbon::make($blocked->repealed_at)->timezone('Asia/Tokyo')->format('Y年m月d日')}}
                            </td>
                        @else
                            <td class="pl-2">
                                {{\Illuminate\Support\Carbon::make($blocked->blocked_at)->timezone('Asia/Tokyo')->format('Y年m月d日')}}{{--
                                --}}@if(\Illuminate\Support\Carbon::make($blocked->blocked_at)->format('YMD')
                                        == \Illuminate\Support\Carbon::make($oldestBlockDate)->format('YMD'))以前@endif
                            </td>
                            <td class="pl-2">
                                {{$blocked->description}}
                            </td>
                        @endif
                    </tr>
                @endforeach
            </table>
        @endempty
    </section>
    <section>
        <a href="{{route('micropen.index')}}" class="border rounded-lg p-2 flex flex-row gap-2 w-fit">
            <span class="iconify heroicons--chevron-left w-6 h-6"></span>
            <div>
                MICROPEN情報に戻る
            </div>
        </a>
    </section>
@endsection
