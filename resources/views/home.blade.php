@extends('layouts.main')

@section('content')
    <section class="my-4 border border-indigo-700 rounded-xl p-4">
        <div class="flex flex-row gap-2 justify-center">
            <span class="material-symbols-outlined">
                person_search
            </span>
            <h2 class="text-xl mb-2">Find Me On...</h2>
        </div>
        <nav class="grid grid-cols-4 gap-4">
            <a href="https://mi.kuropen.org/@kuropen" class="col-span-2 border rounded-lg p-2 flex flex-row gap-2 justify-center">
                <img src="/images/MICROPEN-logo.png" class="w-8 h-8 md:w-12 md:h-12" alt="" />
                <div>
                    <div class="text-sm md:text-lg">MICROPEN <wbr> (Misskey)</div>
                    <div class="hidden md:block">@kuropen@mi.kuropen.org</div>
                </div>
            </a>
            <a href="https://bsky.app/profile/kuropen.org" class="col-span-2 border rounded-lg p-2 flex flex-row gap-2 justify-center">
                <div class="w-8 h-8 md:w-12 md:h-12 p-1 stroke-[#0285FF] fill-[#0285FF]">
                    <svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 10.8c-1.087-2.114-4.046-6.053-6.798-7.995C2.566.944 1.561 1.266.902 1.565.139 1.908 0 3.08 0 3.768c0 .69.378 5.65.624 6.479.815 2.736 3.713 3.66 6.383 3.364.136-.02.275-.039.415-.056-.138.022-.276.04-.415.056-3.912.58-7.387 2.005-2.83 7.078 5.013 5.19 6.87-1.113 7.823-4.308.953 3.195 2.05 9.271 7.733 4.308 4.267-4.308 1.172-6.498-2.74-7.078a8.741 8.741 0 0 1-.415-.056c.14.017.279.036.415.056 2.67.297 5.568-.628 6.383-3.364.246-.828.624-5.79.624-6.478 0-.69-.139-1.861-.902-2.206-.659-.298-1.664-.62-4.3 1.24C16.046 4.748 13.087 8.687 12 10.8Z"/></svg>
                </div>
                <div>
                    <div class="text-sm md:text-lg">Bluesky</div>
                    <div class="hidden md:block">@kuropen.org</div>
                </div>
            </a>
            <a href="https://x.com/kuropen_aizu" class="border rounded-lg p-2">
                <div class="w-8 h-8 md:w-12 md:h-12 p-1 mx-auto">
                    <svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title>X</title><path d="M18.901 1.153h3.68l-8.04 9.19L24 22.846h-7.406l-5.8-7.584-6.638 7.584H.474l8.6-9.83L0 1.154h7.594l5.243 6.932ZM17.61 20.644h2.039L6.486 3.24H4.298Z"/></svg>
                </div>
                <div class="sr-only">X</div>
            </a>
            <a href="https://www.instagram.com/kuropen" class="border rounded-lg p-2">
                <img src="/images/instagram.png" class="mx-auto w-8 h-8 md:w-12 md:h-12" alt="Instagram" />
            </a>
            <a href="https://www.threads.net/kuropen" class="border rounded-lg p-2">
                <div class="w-8 h-8 md:w-12 md:h-12 p-1 mx-auto">
                    <svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title>Threads</title><path d="M12.186 24h-.007c-3.581-.024-6.334-1.205-8.184-3.509C2.35 18.44 1.5 15.586 1.472 12.01v-.017c.03-3.579.879-6.43 2.525-8.482C5.845 1.205 8.6.024 12.18 0h.014c2.746.02 5.043.725 6.826 2.098 1.677 1.29 2.858 3.13 3.509 5.467l-2.04.569c-1.104-3.96-3.898-5.984-8.304-6.015-2.91.022-5.11.936-6.54 2.717C4.307 6.504 3.616 8.914 3.589 12c.027 3.086.718 5.496 2.057 7.164 1.43 1.783 3.631 2.698 6.54 2.717 2.623-.02 4.358-.631 5.8-2.045 1.647-1.613 1.618-3.593 1.09-4.798-.31-.71-.873-1.3-1.634-1.75-.192 1.352-.622 2.446-1.284 3.272-.886 1.102-2.14 1.704-3.73 1.79-1.202.065-2.361-.218-3.259-.801-1.063-.689-1.685-1.74-1.752-2.964-.065-1.19.408-2.285 1.33-3.082.88-.76 2.119-1.207 3.583-1.291a13.853 13.853 0 0 1 3.02.142c-.126-.742-.375-1.332-.75-1.757-.513-.586-1.308-.883-2.359-.89h-.029c-.844 0-1.992.232-2.721 1.32L7.734 7.847c.98-1.454 2.568-2.256 4.478-2.256h.044c3.194.02 5.097 1.975 5.287 5.388.108.046.216.094.321.142 1.49.7 2.58 1.761 3.154 3.07.797 1.82.871 4.79-1.548 7.158-1.85 1.81-4.094 2.628-7.277 2.65Zm1.003-11.69c-.242 0-.487.007-.739.021-1.836.103-2.98.946-2.916 2.143.067 1.256 1.452 1.839 2.784 1.767 1.224-.065 2.818-.543 3.086-3.71a10.5 10.5 0 0 0-2.215-.221z"/></svg>
                </div>
                <div class="sr-only">Threads</div>
            </a>
            <a href="https://github.com/kuropen" class="border rounded-lg p-2">
                <div class="w-8 h-8 md:w-12 md:h-12 p-1 mx-auto">
                    <svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title>GitHub</title><path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"/></svg>
                </div>
                <div class="sr-only">GitHub</div>
            </a>
        </nav>
    </section>
    <section class="my-4 border border-indigo-700 rounded-xl p-4">
        <div class="flex flex-row gap-2 justify-center">
            <span class="material-symbols-outlined">
                article
            </span>
            <h2 class="text-xl mb-2">Latest Articles</h2>
        </div>
        <ul>
            @foreach($documents as $document)
                <li class="border-b mb-2">
                    <a href="{{ $document->url }}" class="flex flex-row align-middle">
                        <div class="flex-grow">
                            {{ $document->title }}
                            ({{\Carbon\Carbon::make($document->published_at)->format('Y年m月d日')}})
                        </div>
                        <div>
                            <span class="material-symbols-outlined">
                                chevron_right
                            </span>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
        <nav class="grid grid-cols-2 gap-2">
            <a href="https://sizu.me/kuropen" class="border rounded-lg p-2">
                しずかなインターネット
            </a>
            <a href="https://penguinone.notion.site/cc3b0e9ccab34bbf95c2bec97dc1e673" class="border rounded-lg p-2">
                雑記帳過去記事 (2023年10月まで）
            </a>
        </nav>
    </section>
    <section class="my-4 border border-indigo-700 rounded-xl p-4">
        <div class="flex flex-row gap-2 justify-center">
            <span class="material-symbols-outlined">
                construction
            </span>
            <h2 class="text-xl mb-2">Works</h2>
        </div>
        <ul>
            <li class="border-b mb-2">
                <a href="https://mi.kuropen.org" class="flex flex-row align-middle">
                    <div class="flex-grow">
                        MICROPEN (Misskey Server)
                    </div>
                    <div>
                        <span class="material-symbols-outlined">
                            chevron_right
                        </span>
                    </div>
                </a>
            </li>
            <li class="border-b mb-2">
                <a href="https://akabe.co" class="flex flex-row align-middle">
                    <div class="flex-grow">
                        Gain the Power from Akabeko
                    </div>
                    <div>
                        <span class="material-symbols-outlined">
                            chevron_right
                        </span>
                    </div>
                </a>
            </li>
        </ul>
        <nav class="grid grid-cols-2 gap-2">
            <a href="https://status.kuropen.org/" class="border rounded-lg p-2">
                障害・メンテナンス情報
            </a>
            <a href="{{route('contact')}}" class="border rounded-lg p-2">
                お問い合わせ
            </a>
        </nav>
    </section>
    <section>
        <a href="/staff-zone" class="border rounded-lg p-2">
            管理画面ログイン
        </a>
    </section>
@endsection
