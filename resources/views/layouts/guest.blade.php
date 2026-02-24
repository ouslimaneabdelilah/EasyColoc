<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-50">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EasyColoc') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-full font-sans antialiased text-slate-900 bg-white">
    <div class="flex min-h-full">
        <div class="relative hidden w-0 flex-1 lg:block">
            <img class="absolute inset-0 h-full w-full object-cover" src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&auto=format&fit=crop&w=2850&q=80" alt="Roommates sharing a meal">
            <div class="absolute inset-0 bg-slate-900/70 mix-blend-multiply"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/40 to-transparent"></div>

            <div class="absolute inset-0 flex flex-col justify-between p-12 lg:p-16 xl:p-24 z-10">
                <div class="flex items-center gap-2">
                    <div class="bg-primary text-white p-2 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <span class="text-white text-2xl font-bold tracking-tight">EasyColoc</span>
                </div>

                <div class="max-w-xl">
                    <h1 class="text-4xl font-bold tracking-tight text-white sm:text-5xl lg:text-5xl xl:text-6xl mb-6 leading-tight">
                        Manage shared expenses <br />
                        <span class="text-primary underline decoration-primary decoration-4 underline-offset-8">without the stress.</span>
                    </h1>
                    <p class="text-lg text-gray-200 leading-relaxed max-w-lg mb-10">
                        The modern platform for roommates to split bills, track shared costs, and settle debts with complete transparency.
                    </p>
                    <div class="flex items-center gap-4">
                        <div class="flex -space-x-4">
                            <img class="w-10 h-10 rounded-full border-2 border-gray-900" src="https://i.pravatar.cc/100?img=1" alt="User">
                            <img class="w-10 h-10 rounded-full border-2 border-gray-900" src="https://i.pravatar.cc/100?img=2" alt="User">
                            <img class="w-10 h-10 rounded-full border-2 border-gray-900" src="https://i.pravatar.cc/100?img=3" alt="User">
                            <img class="w-10 h-10 rounded-full border-2 border-gray-900" src="https://i.pravatar.cc/100?img=4" alt="User">
                        </div>
                        <p class="text-sm font-medium text-gray-300">Trusted by <span class="text-white font-semibold">50,000+</span> roommates</p>
                    </div>
                </div>

                <div>
                    <p class="text-gray-300 italic mb-2">"The easiest way we've found to manage our house finances. No more spreadsheets!"</p>
                    <p class="text-white font-semibold">— The London Loft Crew</p>
                </div>
            </div>
        </div>

        <div class="flex flex-1 flex-col justify-center px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-24 h-screen overflow-y-auto">
            <div class="mx-auto w-full max-w-sm lg:w-[400px]">
                <div class="lg:hidden flex items-center justify-center gap-2 mb-10">
                    <div class="bg-primary text-white p-2 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <span class="text-slate-900 text-2xl font-bold tracking-tight">EasyColoc</span>
                </div>

                {{ $slot }}

                <div class="mt-10 flex justify-center gap-6 text-xs text-slate-500">
                    <a href="#" class="hover:text-slate-900 transition-colors">Help Center</a>
                    <a href="#" class="hover:text-slate-900 transition-colors">Terms of Service</a>
                    <a href="#" class="hover:text-slate-900 transition-colors">Privacy Policy</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>