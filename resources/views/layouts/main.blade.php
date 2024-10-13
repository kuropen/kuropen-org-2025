<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{config('app.name')}}</title>
    @vite('resources/css/app.css')
</head>
<body>
<div class="max-w-[896px] mx-auto my-12 px-7 md:px-10 flex flex-col gap-12">
    <header class="flex flex-col md:flex-row items-center md:items-start gap-3">
        <a href="/" class="md:flex-grow">
            <div class="flex flex-row gap-3">
                <img src="/images/penguin.png" alt="" class="w-10 h-10 rounded-full">
                <h1 class="text-2xl inter">{{config('app.name')}}</h1>
            </div>
        </a>
    </header>
    @yield('content')
</div>
@vite('resources/js/app.ts')
</body>
</html>
