<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'EasyColoc') }} - Manage Your Shared Living</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased bg-slate-50 text-slate-900 font-sans selection:bg-primary/30">

    <!-- Navigation -->
    <nav class="fixed w-full z-50 bg-white/80 backdrop-blur-md border-b border-slate-200 transition-all">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex-shrink-0 flex items-center gap-2">
                    <div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center text-white font-bold text-xl shadow-sm">
                        E
                    </div>
                    <span class="font-bold text-xl tracking-tight text-slate-900">EasyColoc</span>
                </div>
                <div class="flex items-center gap-4">
                    @auth
                    <a href="{{ route('dashboard') }}" class="text-sm font-semibold text-slate-700 hover:text-primary transition-colors">Go to Console</a>
                    @else
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-700 hover:text-primary transition-colors">Log in</a>
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-full shadow-sm text-sm font-medium text-white bg-primary hover:bg-primary-hover focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-all">
                        Get Started
                    </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative pt-32 pb-20 sm:pt-40 sm:pb-24 overflow-hidden">
        <div class="absolute inset-0 -z-10 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-indigo-50 via-white to-white"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative text-center">
            <h1 class="text-5xl md:text-6xl font-extrabold tracking-tight text-slate-900 mb-6 drop-shadow-sm">
                Shared living, <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-purple-600">simplified.</span>
            </h1>
            <p class="mt-4 max-w-2xl mx-auto text-xl text-slate-600 mb-10">
                Manage your roommates, split expenses effortlessly, and keep track of who owes who. EasyColoc brings harmony to your shared home.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                @auth
                <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center px-8 py-3.5 border border-transparent text-base font-medium rounded-full text-white bg-primary hover:bg-primary-hover shadow-md hover:shadow-lg transition-all">
                    Enter App
                    <svg class="ml-2 -mr-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
                @else
                <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-3.5 border border-transparent text-base font-medium rounded-full text-white bg-primary hover:bg-primary-hover shadow-md hover:shadow-lg transition-all">
                    Start for Free
                </a>
                <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-8 py-3.5 border border-slate-300 text-base font-medium rounded-full text-slate-700 bg-white hover:bg-slate-50 transition-all">
                    Sign In
                </a>
                @endauth
            </div>
        </div>

        <!-- Illustration/Decorative -->
        <div class="mt-16 sm:mt-24 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="rounded-2xl bg-white/50 backdrop-blur-xl border border-white/40 shadow-2xl p-4 sm:p-8 aspect-[16/9] flex flex-col items-center justify-center relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-primary/5 to-purple-500/5"></div>
                <!-- Mockup Elements -->
                <div class="w-full max-w-3xl grid grid-cols-1 md:grid-cols-3 gap-6 relative z-10">
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100 flex flex-col items-center">
                        <div class="w-12 h-12 bg-green-100 text-green-600 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="font-bold text-slate-900 mb-2">Track Expenses</h3>
                        <p class="text-sm text-slate-500 text-center">Log every bill and grocery run. Never lose a receipt again.</p>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100 flex flex-col items-center md:-translate-y-4">
                        <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <h3 class="font-bold text-slate-900 mb-2">Manage Roommates</h3>
                        <p class="text-sm text-slate-500 text-center">Invite everyone to the colocation and keep sync'd.</p>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100 flex flex-col items-center">
                        <div class="w-12 h-12 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                            </svg>
                        </div>
                        <h3 class="font-bold text-slate-900 mb-2">Settle Debts</h3>
                        <p class="text-sm text-slate-500 text-center">Automatically calculate who owes what. No more awkward math.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-200 mt-12 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex items-center gap-2">
                <div class="w-6 h-6 bg-primary rounded-md flex items-center justify-center text-white font-bold text-sm">
                    E
                </div>
                <span class="font-bold text-slate-900">EasyColoc</span>
            </div>
            <p class="text-sm text-slate-500 text-center md:text-left">
                &copy; {{ date('Y') }} EasyColoc. All rights reserved. Built with Laravel & Tailwind CSS.
            </p>
        </div>
    </footer>
</body>

</html>