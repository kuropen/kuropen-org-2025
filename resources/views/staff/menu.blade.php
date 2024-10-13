@extends('layouts.main')

@section('content')
    <section>
        <h2 class="text-2xl">管理画面</h2>
        <ul>
            <li>ユーザー名: {{$userName}}</li>
            <li>権限: {{$privilege}}</li>
        </ul>
        <ul>
            <li><a href="{{ route('staff.logout') }}">ログアウト</a></li>
        </ul>
    </section>
@endsection
