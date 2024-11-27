{{--
SPDX-FileCopyrightText: 2024 Kuropen

SPDX-License-Identifier: CC-BY-NC-SA-4.0
--}}

<aside class="flex flex-col gap-2 md:flex-row rounded-lg p-2 {{$class}}" x-data="cookiePolicy" x-show="show">
    <div class="md:flex-grow flex flex-col gap-1">
        <h2 class="font-bold">
            電気通信事業法に基づく表示
        </h2>
        <p>
            このサイトで利用するCookie、このサイトを利用することによって外部事業者に送信される情報などの詳細は、以下をご覧ください。<br>
            <a href="{{route('legal')}}" class="text-blue-800">
                プライバシーポリシー <br class="md:hidden">
                (最終更新 {{\Illuminate\Support\Carbon::make((new DateTime())->setTimestamp($cookiePolicyLastModified))->format('Y年m月d日')}})
            </a>
        </p>
        <p class="text-sm">「確認」ボタンを押すと、以後プライバシーポリシーが更新されるまでこのメッセージは表示されません。</p>
    </div>
    <button
        type="button"
        id="cookie-policy-confirmation-button"
        class="border rounded-lg py-2 px-6 bg-blue-800 text-white shrink-0"
        x-on:click="confirmPolicy"
    >
        確認
    </button>
</aside>

