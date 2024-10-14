@extends('layouts.main')

@section('content')
    <section>
        <h2 class="text-2xl">管理画面</h2>
        <p>
            権限がないユーザーでログインしています。
            <a href="{{ route('staff.logout') }}" class="underline">ログアウト</a>してください。
        </p>
    </section>
@endsection
