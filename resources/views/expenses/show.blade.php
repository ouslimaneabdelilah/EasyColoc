<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('expenses.index', $colocation) }}" class="text-gray-400 hover:text-gray-900 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <h2 class="font-bold text-2xl text-slate-800 leading-tight">
                {{ __('Expense Details') }} - {{ $colocation->name }}
            </h2>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-[#111827]">{{ $expense->title }}</h1>
                <p class="text-[14px] text-gray-500 mt-2 font-medium">Detailed breakdown of this expense.</p>
            </div>
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

        <div class="flex flex-col mb-8 gap-8">
            <div class="bg-white rounded-[16px] border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100 bg-gray-50/50 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <h3 class="text-lg font-bold text-gray-900">Expense Information</h3>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div class="flex flex-col gap-1">
                            <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Amount</span>
                            <span class="text-xl font-extrabold text-gray-900">{{ number_format($expense->amount, 2) }} DH</span>
                        </div>
                        <div class="flex flex-col gap-1">
                            <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Date</span>
                            <span class="text-[15px] font-bold text-gray-900">{{ \Carbon\Carbon::parse($expense->expense_date)->format('d M Y') }}</span>
                        </div>
                        <div class="flex flex-col gap-1">
                            <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Category</span>
                            <div class="flex items-center gap-2 mt-0.5">
                                @if($expense->category)
                                <span class="w-2.5 h-2.5 rounded-full shadow-sm" style="background-color: {{ $expense->category->color ?? '#9ca3af' }}" title="{{ $expense->category->name }}"></span>
                                <span class="text-[15px] font-bold text-gray-900">{{ $expense->category->name }}</span>
                                @else
                                <span class="w-2.5 h-2.5 rounded-full bg-slate-200" title="Uncategorized"></span>
                                <span class="text-[15px] font-bold text-gray-900">No category</span>
                                @endif
                            </div>
                        </div>
                        <div class="flex flex-col gap-1">
                            <span class="text-[11px] font-bold text-gray-400 uppercase tracking-wider">Paid By</span>
                            <span class="text-[15px] font-bold text-gray-900">{{ $expense->payer->id === Auth::id() ? 'You' : ($expense->payer->name ?? 'Unknown') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-[16px] border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100 bg-gray-50/50 flex flex-col gap-2">
                    <h3 class="text-lg font-bold text-gray-900">Expense Action</h3>
                    @php
                    $share = $activeCount > 0 ? $expense->amount / $activeCount : 0;
                    @endphp
                    <p class="text-[13px] text-gray-500">Split evenly among {{ $activeCount }} active members ({{ number_format($share, 2) }} DH each).</p>
                </div>

                <div class="p-6">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center bg-gray-50 p-6 rounded-xl gap-4 border border-gray-100">
                        <div>
                            <h4 class="text-sm font-bold text-gray-900">Your Registration</h4>
                            @if($expense->paid_by !== Auth::id())
                            <p class="text-[13px] text-gray-500 mt-1">Settle your debt for this expense with the person who paid.</p>
                            @else
                            <p class="text-[13px] text-gray-500 mt-1">You paid for this. You don't need to mark anything as paid for yourself.</p>
                            @endif
                        </div>

                        <div class="shrink-0 text-right">
                            @if($expense->paid_by !== Auth::id())
                            @php
                            $hasPaid = $expense->settlements()->where('user_id', Auth::id())->where('status', 'paid')->exists();
                            @endphp

                            @if($hasPaid)
                            <div class="flex flex-col sm:flex-row items-end sm:items-center gap-3">
                                <div class="text-right sm:text-left">
                                    <span class="block text-[11px] uppercase font-bold text-gray-400">You Owed</span>
                                    <span class="block text-sm font-extrabold text-gray-500 line-through">{{ number_format($share, 2) }} DH</span>
                                </div>
                                <button disabled class="px-5 py-2.5 bg-gray-100 text-gray-400 rounded-lg text-sm font-bold shadow-sm cursor-not-allowed border border-gray-200 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Marked Paid
                                </button>
                            </div>
                            @else
                            <form method="POST" action="{{ route('settlements.markAsPaid', $colocation) }}" class="flex flex-col sm:flex-row items-end sm:items-center gap-3">
                                @csrf
                                <input type="hidden" name="expense_id" value="{{ $expense->id }}">
                                <input type="hidden" name="amount" value="{{ round($share, 2) }}">
                                <div class="text-right sm:text-left">
                                    <span class="block text-[11px] uppercase font-bold text-red-500">You Owe</span>
                                    <span class="block text-sm font-extrabold text-gray-900">{{ number_format($share, 2) }} DH</span>
                                </div>
                                <button type="submit" class="px-5 py-2.5 bg-[#4f46e5] text-white hover:bg-indigo-700 rounded-lg text-sm font-bold transition-colors shadow-sm">
                                    Mark Paid
                                </button>
                            </form>
                            @endif

                            @else
                            <div class="flex items-center gap-2 bg-emerald-50 px-4 py-3 rounded-lg border border-emerald-100 shadow-sm">
                                <div class="w-6 h-6 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center">
                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <div class="text-left">
                                    <span class="block text-[11px] uppercase font-bold text-emerald-600">Status</span>
                                    <span class="block text-sm font-extrabold text-gray-900">You Paid Everywhere</span>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>