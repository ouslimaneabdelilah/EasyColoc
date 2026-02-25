<x-app-layout>
    <x-slot name="header">
        Your Colocations - EasyColoc
    </x-slot>

    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-[#111827]">Your Colocations</h1>
                <p class="text-[14px] text-gray-500 mt-2 font-medium">Manage your current and historical shared living arrangements.</p>
            </div>

            <a href="{{ route('colocations.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#0f172a] hover:bg-[#1e293b] rounded-lg font-semibold text-sm text-white focus:outline-none transition ease-in-out shadow-sm">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Create New Colocation
            </a>
        </div>

        @if (session('success'))
        <div class="mb-6 p-4 rounded-lg bg-green-50 border border-green-200 text-green-700 font-medium">
            {{ session('success') }}
        </div>
        @endif

        @if($colocations->isEmpty())
        <div class="bg-white rounded-2xl border border-gray-200 p-12 text-center shadow-sm">
            <div class="w-16 h-16 bg-gray-50 text-gray-400 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">No colocations yet</h3>
            <p class="text-gray-500 mb-6 max-w-sm mx-auto font-medium">Get started by creating a new colocation to manage expenses with your roommates.</p>
        </div>
        @else

        <h2 class="text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-4 flex items-center gap-2">
            <div class="w-2 h-2 rounded-full bg-[#10b981]"></div> ACTIVE COLOCATION
        </h2>

        <div class="space-y-12">
            @foreach($colocations as $colocation)
            <div>
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col md:flex-row items-stretch min-h-[280px]">
                    <div class="md:w-[45%] bg-gray-200 relative h-64 md:h-auto overflow-hidden border-r border-gray-100">
                        <img src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="House" class="absolute inset-0 w-full h-full object-cover">
                    </div>

                    <div class="md:w-[55%] p-8 flex flex-col justify-between">
                        <div>
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <h3 class="text-[22px] font-bold text-gray-900 leading-tight mb-1">{{ $colocation->name }}</h3>
                                    <p class="text-[13px] text-gray-400 font-medium flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11l-3-3-3 3"></path>
                                        </svg>
                                        Nisi nihil culpa no, Dolore vitae exceptu
                                    </p>
                                </div>
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-[#eef2ff] text-[#4f46e5] uppercase tracking-wider">
                                    {{ $colocation->status === 'active' ? 'PRIMARY' : strtoupper($colocation->status) }}
                                </span>
                            </div>

                            <div class="grid grid-cols-3 gap-6 mt-10 border-b border-gray-100 pb-8">
                                <div>
                                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Members</p>
                                    <p class="text-base font-bold text-gray-900 flex items-baseline gap-1">
                                        {{ $colocation->users()->count() }} <span class="text-xs font-medium text-gray-500">Active</span>
                                    </p>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Active Since</p>
                                    <p class="text-sm font-bold text-gray-900 mt-1">
                                        {{ $colocation->created_at->format('M Y') }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Open Button -->
                        <div class="flex justify-end mt-6">
                            <a href="{{ route('colocations.show', $colocation) }}" class="inline-flex items-center gap-2 px-6 py-2.5 bg-[#4f46e5] border border-transparent rounded-lg font-semibold text-sm text-white hover:bg-indigo-700 transition ease-in-out shadow-sm">
                                Open colocation
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</x-app-layout>