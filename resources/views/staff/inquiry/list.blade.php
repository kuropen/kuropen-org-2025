@extends('layouts.main')

@section('content')
    <section>
        <h2 class="text-2xl mb-4 border-b border-b-gray-300">管理画面</h2>
        <h3 class="text-xl mb-2">問い合わせ内容一覧</h3>
        <ul class="mb-4">
            @foreach($inquiries as $inquiry)
                <li class="my-1 flex flex-row p-1 gap-2">
                    <div class="flex-grow">
                        {{$inquiry->created_at->timezone('Asia/Tokyo')->format('Y年m月d日 H:i:s')}}
                    </div>
                    <a href="{{ route('staff.inquiry.show', ['slug' => $inquiry->slug]) }}" class="border rounded-lg p-1">
                        表示
                    </a>
                    <form action="{{route('staff.inquiry.delete')}}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$inquiry->id}}">
                        <button type="submit" class="text-white bg-red-800 rounded-lg p-1"
                                onclick="return confirm('本当に削除しますか？')">削除</button>
                    </form>
                </li>
            @endforeach
        </ul>
        <ul class="flex flex-row gap-4">
            <li><a href="{{ route('staff.menu') }}" class="border rounded-lg p-2">メニューへ戻る</a></li>
            <li><a href="{{ route('staff.logout') }}" class="text-white bg-red-800 rounded-lg p-2">ログアウト</a></li>
        </ul>
    </section>
@endsection
