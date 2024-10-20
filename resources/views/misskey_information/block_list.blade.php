<!--
SPDX-FileCopyrightText: 2024 Kuropen

SPDX-License-Identifier: CC-BY-NC-SA-4.0
-->

@extends('layouts.subpage')
@section('page_title', 'MICROPENからブロックされているサーバー')
@section('content')
    <section>
        <h2 class="text-xl mb-2">MICROPENからブロックされているサーバー</h2>
        <p class="mb-2">以下のサーバーは当サーバーからブロックされています。</p>
        <table class="mx-auto table-auto">
            <tr class="border">
                <th>ホスト名</th>
                <th>ブロック実施日</th>
                <th>ブロック解除日</th>
            </tr>
            @foreach($blockedList as $blocked)
                <tr class="border">
                    <td>{{$blocked->hostname}}</td>
                    <td class="px-2">
                        {{\Illuminate\Support\Carbon::make($blocked->blocked_at)->format('Y年m月d日')}}{{--
                        --}}@if(\Illuminate\Support\Carbon::make($blocked->blocked_at)->format('YMD')
                                == \Illuminate\Support\Carbon::make($oldestBlockDate)->format('YMD'))以前@endif
                    </td>
                    <td>
                        @if(is_null($blocked->repealed_at))
                            継続中
                        @else
                            {{\Illuminate\Support\Carbon::make($blocked->repealed_at)->format('Y年m月d日')}}
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    </section>
    <section>
        <a href="{{route('micropen.index')}}" class="border rounded-lg p-2 flex flex-row gap-2 w-fit">
            <span class="material-symbols-outlined">
                chevron_left
            </span>
            <div>
                MICROPEN情報に戻る
            </div>
        </a>
    </section>
@endsection
