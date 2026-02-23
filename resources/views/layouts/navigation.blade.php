<aside class="w-64 bg-slate-50 border-r border-slate-200 flex flex-col justify-between hidden md:flex h-full min-h-screen">
    <div class="p-6">
        <div class="flex items-center gap-3 mb-10">
            <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center text-white font-bold text-xl shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
            </div>
            <span class="font-bold text-xl tracking-tight text-slate-900">EasyColoc</span>
        </div>

        <div class="mb-4">
            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-3">Main Menu</p>
            <nav class="space-y-1">
                @if(Auth::user() && Auth::user()->role === 'admin')
                <a href="{{ route('admin.stats') }}" class="{{ request()->routeIs('admin.stats') ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-100' }} flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-colors">
                    <svg class="w-5 h-5 {{ request()->routeIs('admin.stats') ? 'text-indigo-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                    </svg>
                    Dashboard
                </a>
                @endif
                <a href="{{ route('colocations.index') }}" class="{{ request()->routeIs('colocations.index') || request()->routeIs('colocations.show') ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-100' }} flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-colors">
                    <svg class="w-5 h-5 {{ request()->routeIs('colocations.*') && !request()->routeIs('expenses.*') ? 'text-indigo-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Colocations
                </a>

                @php
                $activeColoc = Auth::user() ? Auth::user()->colocations()->whereNull('left_at')->first() : null;
                @endphp
                <a href="{{ $activeColoc ? route('expenses.index', $activeColoc) : '#' }}" class="{{ request()->routeIs('expenses.*') ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-100' }} flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors {{ !$activeColoc ? 'opacity-40 cursor-not-allowed' : '' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('expenses.*') ? 'text-indigo-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Expenses
                </a>
                <a href="{{ $activeColoc ? route('colocations.categories.index', $activeColoc) : '#' }}" class="{{ request()->routeIs('colocations.categories.*') ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-100' }} flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-colors {{ !$activeColoc ? 'opacity-40 cursor-not-allowed' : '' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('colocations.categories.*') ? 'text-indigo-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                    Categories
                </a>
            </nav>
        </div>

        <div>
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2 mt-4 ml-1">Account</p>
            <nav class="space-y-1">
                <a href="#" class="text-slate-600 hover:bg-slate-100 flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Settings
                </a>
            </nav>
        </div>
    </div>

    <div class="p-4 border-t border-slate-200 bg-white shadow-sm mt-auto">
        @auth
        <div class="flex items-center gap-3 mb-4 mt-2 px-2">
            <div class="h-10 w-10 flex-shrink-0 bg-indigo-600 rounded-lg flex items-center justify-center text-white font-bold shadow-sm">
                {{ substr(Auth::user()->name, 0, 2) }}
            </div>
            <div class="flex flex-col truncate w-full">
                <span class="text-sm font-bold text-slate-900 truncate tracking-tight">{{ Auth::user()->name }}</span>
                <span class="text-[10px] text-slate-500 truncate">{{ Auth::user()->email }}</span>
                <div class="mt-1">
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-full {{ Auth::user()->reputation >= 0 ? 'bg-emerald-100 text-emerald-800' : 'bg-red-100 text-red-800' }}">
                        Rep: {{ Auth::user()->reputation > 0 ? '+' : '' }}{{ Auth::user()->reputation }}
                    </span>
                </div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}" class="w-full px-2">
            @csrf
            <button type="submit" class="w-full text-left flex items-center gap-2 text-sm font-semibold text-red-600 hover:text-red-700 transition duration-150 py-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                Sign Out
            </button>
        </form>
        @endauth
    </div>
</aside>