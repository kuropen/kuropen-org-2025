@extends('layouts.main')

@section('content')
    <section>
        <h2 class="text-2xl">管理画面</h2>
        <h3 class="text-xl">問い合わせ内容確認</h3>
        <ul>
            <li>お名前: {{$inquiry->name}}</li>
            <li>メールアドレス: <a href="mailto:{{$inquiry->email}}">{{$inquiry->email}}</a></li>
            <li>お問い合わせ種別: {{$inquiry->type->name}}</li>
            <li>お問い合わせ内容: {{$inquiry->message}}</li>
        </ul>
        <ul>
            <li><a href="{{ route('staff.logout') }}">ログアウト</a></li>
        </ul>
    </section>
@endsection
