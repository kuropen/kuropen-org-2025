{{--
SPDX-FileCopyrightText: 2025 Kuropen

SPDX-License-Identifier: CC-BY-NC-SA-4.0
--}}
<footer>
    <address class="not-italic">
        Copyright (C) {{date('Y')}} Kuropen.
    </address>
    <div class="flex flex-col md:flex-row gap-2 md:gap-4">
        <a href="{{ route('about') }}" class="link-text">サイト情報・著作権について</a>
        <a href="{{ route('legal') }}" class="link-text">プライバシーポリシー</a>
    </div>
</footer>
