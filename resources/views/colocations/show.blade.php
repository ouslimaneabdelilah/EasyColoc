<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('colocations.index') }}" class="text-gray-400 hover:text-gray-900 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            {{ $colocation->name }}
            <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-[#eef2ff] text-[#4f46e5] uppercase tracking-wider">
                {{ $colocation->status === 'active' ? 'PRIMARY' : strtoupper($colocation->status) }}
            </span>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-extrabold text-[#111827]">Colocation Dashboard</h1>
                <p class="text-[14px] text-gray-500 mt-2 font-medium">Manage members, view balance, and add expenses for {{ $colocation->name }}.</p>
            </div>

            <a href="{{ route('expenses.create', $colocation) }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#4f46e5] hover:bg-indigo-700 rounded-lg font-semibold text-sm text-white focus:outline-none transition ease-in-out shadow-sm">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add New Expense
            </a>
        </div>

        @if (session('success'))
        <div class="mb-6 p-4 rounded-lg bg-green-50 border border-green-200 text-green-700 font-medium text-sm">
            {{ session('success') }}
        </div>
        @endif
        @if ($errors->any())
        <div class="mb-6 p-4 rounded-lg bg-red-50 text-red-600 border border-red-100 font-medium text-sm">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-1 space-y-6">


                <div class="bg-white rounded-[16px] border border-gray-100 p-6 shadow-sm">
                    <h3 class="text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-4 ml-1">Quick Actions</h3>

                    <div class="space-y-3 flex flex-col">
                        @if($isOwner)
                        <button onclick="document.getElementById('inviteModal').classList.remove('hidden')" class="w-full flex items-center justify-between rounded-xl bg-[#f8fafc] border border-gray-200/60 px-5 py-3 text-[13px] font-bold text-gray-700 shadow-sm hover:border-gray-300 hover:bg-white transition-all">
                            <span class="flex items-center gap-3">
                                <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                </svg>
                                Invite Member
                            </span>
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                        @endif

                        <a href="{{ route('colocations.categories.index', $colocation) }}" class="w-full flex items-center justify-between rounded-xl bg-[#f8fafc] border border-gray-200/60 px-5 py-3 text-[13px] font-bold text-gray-700 shadow-sm hover:border-gray-300 hover:bg-white transition-all">
                            <span class="flex items-center gap-3">
                                <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                                Add Categories
                            </span>
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>

                        <a href="{{ route('debts.index', $colocation) }}" class="w-full flex items-center justify-between rounded-xl bg-[#f8fafc] border border-gray-200/60 px-5 py-3 text-[13px] font-bold text-gray-700 shadow-sm hover:border-gray-300 hover:bg-white transition-all">
                            <span class="flex items-center gap-3">
                                <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 14l6-6m-5.5.5h.01m4.99 5h.01M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                Settle Debts
                            </span>
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                @if($isOwner || ($currentUserPivot && !$currentUserPivot->left_at))
                <div class="bg-red-50/50 rounded-[16px] border border-red-100 p-6 shadow-sm">
                    <h3 class="text-[11px] font-bold text-red-500 uppercase tracking-widest mb-4 ml-1">Danger Zone</h3>

                    @if($isOwner)
                    <form action="{{ route('colocations.cancel', $colocation) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this colocation? This action cannot be undone.');">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-between rounded-xl bg-white border border-red-200 px-5 py-3 text-[13px] font-bold text-red-600 shadow-sm hover:border-red-300 hover:bg-red-50 transition-all">
                            <span class="flex items-center gap-3">
                                <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Cancel Colocation
                            </span>
                        </button>
                    </form>
                    @else
                    <form action="{{ route('colocations.members.remove', [$colocation, Auth::id()]) }}" method="POST" onsubmit="return confirm('Are you sure you want to leave this colocation?');">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-between rounded-xl bg-white border border-red-200 px-5 py-3 text-[13px] font-bold text-red-600 shadow-sm hover:border-red-300 hover:bg-red-50 transition-all">
                            <span class="flex items-center gap-3">
                                <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                Leave Colocation
                            </span>
                        </button>
                    </form>
                    @endif
                </div>
                @endif
            </div>

            <div class="lg:col-span-2">
                <div class="bg-white rounded-[16px] border border-gray-100 shadow-sm overflow-hidden h-full">
                    <div class="px-8 py-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                        <h3 class="text-lg font-bold text-gray-900">Roommates</h3>
                        <span class="bg-[#eef2ff] text-[#4f46e5] py-1 px-3 rounded-md text-[11px] font-bold">{{ $users->count() }} MEMBERS</span>
                    </div>

                    <ul class="divide-y divide-gray-100 p-2">
                        @foreach($users as $user)
                        <li class="px-6 py-5 flex items-center justify-between hover:bg-gray-50 rounded-xl transition-colors group">
                            <div class="flex items-center gap-4">
                                <div class="flex items-center justify-center w-10 h-10 rounded-lg shadow-sm border border-[#4f46e5]/10 bg-[#4f46e5]/10 text-[#4f46e5] font-bold text-[15px] uppercase">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                <div class="flex flex-col gap-0.5">
                                    <div class="flex items-center gap-2">
                                        <p class="text-[15px] font-bold text-gray-900">
                                            {{ $user->name }}
                                        </p>
                                        @if($user->pivot->role === 'owner')
                                        <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-bold bg-amber-50 text-amber-600 border border-amber-100">Owner</span>
                                        @endif
                                        @if($user->pivot->left_at)
                                        <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-bold bg-gray-100 text-gray-600 border border-gray-200">Left</span>
                                        @endif
                                        @if($user->id === Auth::id())
                                        <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-bold bg-indigo-50 text-indigo-600 border border-indigo-100">You</span>
                                        @endif
                                    </div>
                                    <p class="text-[13px] text-gray-400 font-medium">{{ $user->email }}</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-4">
                                @php
                                $userBalance = $balances[$user->id] ?? 0;
                                @endphp
                                <div class="text-right flex flex-col items-end mr-2">
                                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-0.5">Balance</span>
                                    <span class="text-[14px] font-extrabold ticket-balance {{ $userBalance > 0 ? 'text-emerald-500' : ($userBalance < 0 ? 'text-rose-500' : 'text-gray-400') }}">
                                        {{ $userBalance > 0 ? '+' : ''}}{{ number_format($userBalance, 2) }} DH
                                    </span>
                                </div>

                                @if(!$user->pivot->left_at)
                                <div class="flex items-center sm:opacity-0 group-hover:opacity-100 transition-opacity">
                                    @if($isOwner && $user->id !== Auth::id())
                                    <form action="{{ route('colocations.members.remove', [$colocation, $user]) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this member?');">
                                        @csrf
                                        <button type="submit" class="px-4 py-2 text-[13px] font-semibold text-red-600 bg-red-50 hover:bg-red-100 rounded-lg transition-colors border border-red-100 flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            Remove
                                        </button>
                                    </form>
                                    @endif
                                </div>
                                @endif
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Invite Modal -->
    <div id="inviteModal" class="relative z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-900/75 backdrop-blur-sm transition-opacity"></div>
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-2xl bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                    <div class="absolute right-0 top-0 hidden pr-4 pt-4 sm:block">
                        <button type="button" onclick="document.getElementById('inviteModal').classList.add('hidden')" class="rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2">
                            <span class="sr-only">Close</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div>
                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-indigo-50">
                            <svg class="h-8 w-8 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-5">
                            <h3 class="text-xl font-bold leading-6 text-gray-900" id="modal-title">Invite Roommate</h3>
                            <div class="mt-2">
                                <p class="text-[14px] font-medium text-gray-500">Enter the email address of the person you want to invite to <span class="font-bold text-gray-800">{{ $colocation->name }}</span>.</p>
                            </div>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('invitations.invite') }}" class="mt-6 sm:mt-6">
                        @csrf
                        <input type="hidden" name="colocation_id" value="{{ $colocation->id }}">

                        <div>
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" required class="block w-full rounded-xl border-0 py-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-200 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="roommate@example.com">
                        </div>

                        <div class="mt-6 sm:flex sm:flex-row-reverse sm:gap-3">
                            <button type="submit" class="inline-flex w-full justify-center rounded-xl bg-indigo-600 px-3 py-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 sm:w-auto transition-colors">Send Invitation</button>
                            <button type="button" onclick="document.getElementById('inviteModal').classList.add('hidden')" class="mt-3 inline-flex w-full justify-center rounded-xl bg-white px-3 py-3 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto transition-colors">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>