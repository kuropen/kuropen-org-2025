<!--
SPDX-FileCopyrightText: 2024 Kuropen

SPDX-License-Identifier: CC-BY-NC-SA-4.0
-->

@extends('layouts.subpage')
@section('page_title', 'お問い合わせフォーム')
@section('head')
    <script src="https://www.google.com/recaptcha/enterprise.js" async defer></script>
@endsection
@section('content')
<section x-data="inquiryFormTool('{!! base64_encode(json_encode($types->map(fn($type) => ["id" => $type->id, "valid" => $type->valid, "description" => $type->description, "invitation" => $type->invitation])->toArray())) !!}', '{!! $givenTypeId !!}')">
    <h2 class="text-2xl mb-4">Contact - お問い合わせフォーム</h2>
    <div class="my-4 flex flex-row gap-2 p-4 bg-yellow-200 rounded-lg border">
        <div class="shrink-0">
            <span class="iconify heroicons--information-circle w-12 h-12"></span>
        </div>
        <div class="grid grid-cols-1 gap-1">
            <p class="font-bold">以下の事項に同意の上で送信してください。</p>
            <p>お問い合わせ内容によっては、返信にお時間をいただく場合がございます。</p>
            <p>このフォームは問い合わせを行った方に確認メールを送信いたしません。</p>
            <p>MICROPENの不正利用の通報については、その対応を確約するものではありません。</p>
            <p>このフォームに入力された個人情報は日本国外のサーバーに保管されます。詳しくは<a href="{{route('legal')}}" class="link-text">プライバシーポリシー</a>をご覧ください。</p>
        </div>
    </div>
    <div class="my-4">
        <form action="{{route('contact.send')}}" method="post">
            @csrf
            <div
                class="flex mb-4 flex-row gap-2 p-4 bg-yellow-200 rounded-lg border"
                x-show="$refs.errorList.childElementCount > 0"
            >
                <span class="iconify heroicons--exclamation-circle w-12 h-12"></span>
                <div>
                    <p>入力内容に不備があります。</p>
                    <ul x-ref="errorList">
                        @foreach(['name', 'email', 'type_id', 'message', 'terms_agree', 'g-recaptcha-response'] as $field)
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
                    <input type="text" name="name" id="name" value="{{old('name')}}" class="w-full border rounded-lg p-2" required>
                </div>
                <div>
                    <label for="email">メールアドレス</label>
                    <input type="email" name="email" id="email" value="{{old('email')}}" class="w-full border rounded-lg p-2" required>
                </div>
                <div>
                    <label for="type_id">お問い合わせ種別</label>
                    <select
                        id="type_id"
                        x-model="selectedType"
                        x-on:change="typeCheck()"
                        name="type_id"
                        class="w-full rounded-lg" required>
                        @foreach($types as $type)
                            <option value="{{$type->id}}" @selected($givenTypeId == $type->id)>{{$type->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="message">お問い合わせ内容</label>
                    <textarea :placeholder="selectedTypeDescription" name="message" rows="5" id="message" class="w-full border rounded-lg p-2" required>{{old('message')}}</textarea>
                </div>
                <div class="my-4 flex flex-col gap-2 p-4 bg-yellow-200 rounded-lg border" x-show="selectedTypeIsInvitation">
                    <p>
                        お問い合わせ内容が「招待コード発行依頼」の場合、<a href="{{route('micropen.terms')}}" class="link-text" target="_blank">MICROPEN利用規約</a>への同意が必要となります。<br>
                        また、お問い合わせ内容に、面識のある当サーバーユーザーの名前や、そのユーザーとの関係性など、招待コードを発行すべきかどうか判断するための情報を含めてください。<br>
                        これがない場合、請求を却下させていただきます。また、却下された場合の返信はいたしません。
                    </p>
                    <div class="flex flex-row gap-2 border p-2 justify-center">
                        <input type="checkbox" name="terms_agree" id="terms_agree" value="true" class="border rounded-lg p-2">
                        <label for="terms_agree">上記に同意する</label>
                    </div>
                </div>
                <div class="mx-auto">
                    <div class="g-recaptcha" data-sitekey="{{config('const.recaptcha.site_key')}}" data-action="contact_form"></div>
                </div>
                <div>
                    <button
                        type="submit"
                        class="border rounded-lg p-2 text-white w-full"
                        :class="isSendButtonDisabled ? 'bg-gray-500 cursor-not-allowed' : 'bg-blue-900'"
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
        <span class="iconify heroicons--chevron-left w-6 h-6"></span>
        <div>
            トップページに戻る
        </div>
    </a>
</section>
@endsection
