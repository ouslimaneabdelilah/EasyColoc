<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EasyColoc') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-full font-sans antialiased text-slate-900 bg-slate-50 overflow-hidden">
    <div class="flex h-screen overflow-hidden">

        @include('layouts.navigation')

        <div class="md:hidden fixed top-0 left-0 right-0 bg-white border-b border-slate-200 z-50 px-4 py-3 flex justify-between items-center">
            <span class="font-bold text-xl text-slate-900">EasyColoc</span>
            <button class="text-slate-500 hover:text-slate-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>

        <div class="flex-1 flex flex-col overflow-y-auto mt-14 md:mt-0 bg-[#f8fafc]">

            @if (isset($header))
            <header class="bg-white border-b border-slate-200 sticky top-0 z-40">
                <div class="px-8 py-5 flex items-center text-sm">
                    <span class="text-slate-400 font-bold tracking-wider text-[10px] uppercase">Dashboard</span>
                    <span class="mx-3 text-slate-300">/</span>
                    <span class="text-slate-900 font-bold">{{ $header }}</span>
                </div>
            </header>
            @endif

            <main class="flex-1 p-6 md:p-10 w-full mx-auto">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>