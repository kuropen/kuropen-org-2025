{{--
SPDX-FileCopyrightText: 2024 Kuropen

SPDX-License-Identifier: CC-BY-NC-SA-4.0
--}}

<p>{{config('app.name')}}のお問い合わせフォームに入力がありました。</p>
<ul>
<li>お名前: {{$record->name}}</li>
<li>メールアドレス: {{$record->email}}</li>
<li>お問い合わせ種別: {{$record->type->name}}</li>
</ul>
<p>内容の詳細は以下で確認してください。<br />
<a href="{{route('staff.inquiry.show', ['slug' => $record->slug])}}">{{route('staff.inquiry.show', ['slug' => $record->slug])}}</a>
</p>
