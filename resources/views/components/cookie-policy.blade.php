{{--
SPDX-FileCopyrightText: 2024 Kuropen

SPDX-License-Identifier: CC-BY-NC-SA-4.0
--}}

<aside
    class="fixed bottom-0 left-0 w-full bg-white bg-opacity-85"
    x-data="cookiePolicy"
    x-show="show"
    x-ref="policySection"
    x-effect="setPageMargin($refs.policySection.getBoundingClientRect().height)"
>
    <div class="flex flex-col gap-2 md:flex-row rounded-lg m-2 p-2 {{$class}}">
        <div class="md:flex-grow flex flex-col gap-1">
            <p>
                このサイトで利用するCookie、このサイトを利用することによって外部事業者に送信される情報などの詳細は、以下をご覧ください。<br>
                <a href="{{route('legal')}}" class="{{$linkClass}}">
                    プライバシーポリシー <br class="md:hidden">
                    (最終更新 {{\Illuminate\Support\Carbon::make((new DateTime())->setTimestamp($cookiePolicyLastModified))->format('Y年m月d日')}})
                </a>
            </p>
        </div>
        <button
            type="button"
            id="cookie-policy-confirmation-button"
            class="border rounded-lg py-2 px-6 bg-blue-900 text-white shrink-0"
            x-on:click="confirmPolicy"
        >
            確認
        </button>
    </div>
</aside>

