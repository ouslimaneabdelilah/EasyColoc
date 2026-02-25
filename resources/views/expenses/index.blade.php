<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('colocations.show', $colocation) }}" class="text-gray-400 hover:text-gray-900 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <h2 class="font-bold text-2xl text-slate-800 leading-tight">
                {{ __('Expenses') }} - {{ $colocation->name }}
            </h2>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-[#111827]">Colocation Expenses</h1>
                <p class="text-[14px] text-gray-500 mt-2 font-medium">Track shared expenses and keep everything balanced.</p>
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

        <div class="flex flex-col mb-8">
            <div class="bg-white rounded-[16px] border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100 bg-gray-50/50 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <h3 class="text-lg font-bold text-gray-900">Recent Expenses</h3>

                    <!-- Month Filter -->
                    <form method="GET" action="{{ route('expenses.index', $colocation) }}" class="flex items-center gap-3">
                        <div class="relative">
                            <input type="month" name="month" value="{{ request('month', date('Y-m')) }}" class="block w-full text-sm border-gray-200 rounded-xl focus:ring-[#4f46e5] focus:border-[#4f46e5] shadow-sm px-4 py-2 bg-white cursor-pointer" onchange="this.form.submit()">
                        </div>
                        @if(request()->has('month'))
                        <a href="{{ route('expenses.index', $colocation) }}" class="text-sm font-medium text-slate-500 hover:text-[#4f46e5] transition-colors">Clear</a>
                        @endif
                    </form>
                </div>

                @if($expenses->isEmpty())
                <div class="p-16 text-center">
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-[#eef2ff] mb-4">
                        <svg class="h-8 w-8 text-[#4f46e5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-1">No expenses found</h3>
                    <p class="text-[14px] text-slate-500 max-w-sm mx-auto">There are no expenses recorded for this period. Add an expense or change the month filter to see past records.</p>
                </div>
                @else
                <ul class="divide-y divide-gray-100 p-2">
                    @foreach($expenses as $expense)
                    <li class="px-6 py-5 flex flex-col hover:bg-gray-50 rounded-xl transition-colors group gap-4">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 w-full">
                            <div class="flex items-center gap-4 relative">
                                <!-- Date Indicator -->
                                <div class="flex flex-col items-center justify-center bg-white border border-gray-200 shadow-sm rounded-lg w-12 h-12 text-center shrink-0">
                                    <span class="text-[9px] font-bold text-[#4f46e5] uppercase leading-none mb-0.5">{{ \Carbon\Carbon::parse($expense->expense_date)->format('M') }}</span>
                                    <span class="text-[16px] font-extrabold text-gray-900 leading-none">{{ \Carbon\Carbon::parse($expense->expense_date)->format('d') }}</span>
                                </div>

                                <div class="flex flex-col gap-1">
                                    <div class="flex items-center gap-2">
                                        @if($expense->category)
                                        <span class="w-2.5 h-2.5 rounded-full shadow-sm" style="background-color: {{ $expense->category->color }}" title="{{ $expense->category->name }}"></span>
                                        @else
                                        <span class="w-2.5 h-2.5 rounded-full bg-slate-200" title="Uncategorized"></span>
                                        @endif
                                        <p class="text-[15px] font-bold text-gray-900">{{ $expense->title }}</p>
                                    </div>

                                    <div class="flex items-center gap-2 text-[13px] text-gray-500 font-medium">
                                        <span>Paid by <strong class="text-gray-800">{{ $expense->payer->id === Auth::id() ? 'You' : ($expense->payer->name ?? 'Unknown') }}</strong></span>
                                        <span class="w-1 h-1 rounded-full bg-gray-300"></span>
                                        <span>{{ $expense->category ? $expense->category->name : 'No category' }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center justify-between sm:justify-end gap-4 sm:w-1/3">
                                <div class="text-left sm:text-right">
                                    <span class="block text-[16px] font-extrabold text-gray-900">{{ number_format($expense->amount, 2) }} DH</span>
                                    <span class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mt-0.5">Amount</span>
                                </div>

                                <div class="flex items-center gap-2">
                                    <a href="{{ route('expenses.show', [$colocation, $expense]) }}" class="px-4 py-2 text-[13px] font-semibold text-indigo-600 bg-indigo-50 hover:bg-indigo-100 rounded-lg transition-colors border border-indigo-100 flex items-center gap-1">
                                        Details
                                        <svg class="w-4 h-4 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>

                                    @if($isOwner || $expense->paid_by === Auth::id())
                                    <div class="sm:opacity-0 group-hover:opacity-100 transition-opacity">
                                        <form method="POST" action="{{ route('expenses.destroy', [$colocation, $expense]) }}" onsubmit="return confirm('Are you sure you want to delete this expense? This will recalculate everyone\'s balance.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-red-600 bg-red-50 hover:bg-red-100 rounded-lg transition-colors border border-red-100" title="Delete Expense">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>



                    </li>
                    @endforeach
                </ul>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>