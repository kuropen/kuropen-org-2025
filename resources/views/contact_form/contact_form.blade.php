@extends('layouts.subpage')
@section('page_title', 'お問い合わせフォーム')
@section('content')
<section x-data="{
    invalidTypeChoices: @json($types->filter(fn($type) => !$type->valid)->map(fn($type) => $type->id)->toArray()),
    isSendButtonDisabled: true,
    typeCheck() {
        this.isSendButtonDisabled = this.invalidTypeChoices.includes(parseInt(this.$refs.typeSelect.value));
    },
    init() {
        this.typeCheck();
    }
}">
    <h2 class="text-2xl mb-4">Contact - お問い合わせフォーム</h2>
    <div class="my-4 flex flex-row gap-2 p-4 bg-yellow-200 rounded-lg border">
        <div class="shrink-0">
            <span class="material-symbols-outlined">
                info
            </span>
        </div>
        <div class="grid grid-cols-1 gap-1">
            <p>お問い合わせ内容によっては、返信にお時間をいただく場合がございます。</p>
            <p>このフォームは問い合わせを行った方に確認メールを送信いたしません。</p>
            <p>MICROPENの不正利用の通報については、その対応を確約するものではありません。</p>
        </div>
    </div>
    <div class="my-4">
        <form action="{{route('contact.send')}}" method="post">
            @csrf
            <div
                class="flex mb-4 flex-row gap-2 p-4 bg-yellow-200 rounded-lg border"
                x-show="$refs.errorList.childElementCount > 0"
            >
                <span class="material-symbols-outlined">
                    problem
                </span>
                <div>
                    <p>入力内容に不備があります。</p>
                    <ul x-ref="errorList">
                        @foreach(['name', 'email', 'type_id', 'message'] as $field)
                            @error($field)
                                <li>{{ $message }}</li>
                            @enderror
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label for="name">お名前</label>
                    <input type="text" name="name" id="name" value="{{old('name')}}" class="w-full border rounded-lg p-2">
                </div>
                <div>
                    <label for="email">メールアドレス</label>
                    <input type="email" name="email" id="email" value="{{old('email')}}" class="w-full border rounded-lg p-2">
                </div>
                <div>
                    <label for="type_id">お問い合わせ種別</label>
                    <select
                        id="type_id"
                        x-ref="typeSelect"
                        x-on:change="typeCheck()"
                        name="type_id"
                        class="w-full rounded-lg">
                        @foreach($types as $type)
                            <option value="{{$type->id}}" @selected($givenTypeId == $type->id)>{{$type->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="message">お問い合わせ内容</label>
                    <textarea name="message" rows="5" id="message" class="w-full border rounded-lg p-2">{{old('message')}}</textarea>
                </div>
                <div>
                    <button
                        type="submit"
                        class="border rounded-lg p-2 text-white w-full"
                        :class="isSendButtonDisabled ? 'bg-gray-500' : 'bg-blue-500'"
                        :disabled="isSendButtonDisabled"
                    >
                        送信
                    </button>
                </div>
            </div>
        </form>
    </div>
</section>
<section>
    <a href="/" class="border rounded-lg p-2 flex flex-row gap-2 w-fit">
            <span class="material-symbols-outlined">
                chevron_left
            </span>
        <div>
            トップページに戻る
        </div>
    </a>
</section>
@endsection
