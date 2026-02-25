<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('colocations.show', $colocation) }}" class="text-gray-400 hover:text-gray-900 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            Add New Expense
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-xl border border-slate-200/80">
                <div class="px-6 py-6 sm:p-8">

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-slate-900">New Expense in {{ $colocation->name }}</h3>
                        <p class="mt-1 text-sm text-slate-500">
                            Add a new expense. Choose who paid and categorize the expense.
                        </p>
                    </div>

                    @if (session('error'))
                    <div class="mb-5 bg-red-50/80 border border-red-200 text-red-600 px-4 py-3 rounded-lg text-sm">
                        {{ session('error') }}
                    </div>
                    @endif

                    @if ($errors->any())
                    <div class="mb-5 bg-red-50/80 border border-red-200 text-red-600 px-4 py-3 rounded-lg text-sm">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form method="POST" action="{{ route('expenses.store', $colocation) }}" class="space-y-5">
                        @csrf

                        <div>
                            <label for="title" class="block text-sm font-medium text-slate-700 mb-1.5">
                                Expense Title <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="title" id="title" required
                                class="block w-full text-sm border-slate-300 rounded-lg focus:ring-slate-900 focus:border-slate-900 shadow-sm px-3 py-2 transition-colors"
                                placeholder="E.g., Groceries, Electricity bill"
                                value="{{ old('title') }}">
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="amount" class="block text-sm font-medium text-slate-700 mb-1.5">
                                    Amount <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="number" step="0.01" min="0.01" name="amount" id="amount" required
                                        class="block w-full text-sm border-slate-300 rounded-lg focus:ring-slate-900 focus:border-slate-900 shadow-sm pl-3 pr-8 py-2 transition-colors"
                                        placeholder="0.00"
                                        value="{{ old('amount') }}">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <span class="text-slate-500 sm:text-sm">DH</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label for="expense_date" class="block text-sm font-medium text-slate-700 mb-1.5">
                                    Date <span class="text-red-500">*</span>
                                </label>
                                <input type="date" name="expense_date" id="expense_date" required
                                    class="block w-full text-sm border-slate-300 rounded-lg focus:ring-slate-900 focus:border-slate-900 shadow-sm px-3 py-2 transition-colors"
                                    value="{{ old('expense_date', date('Y-m-d')) }}">
                            </div>
                        </div>

                        <div>
                            <div class="flex items-center justify-between mb-1.5">
                                <label for="category_id" class="block text-sm font-medium text-slate-700">
                                    Category
                                </label>
                                @if($categories->count() > 0)
                                <a href="{{ route('colocations.categories.index', $colocation) }}" class="text-[12px] font-medium text-indigo-600 hover:text-indigo-800 transition-colors">Manage Categories</a>
                                @endif
                            </div>

                            @if($categories->count() > 0)
                            <div class="relative">
                                <select name="category_id" id="category_id" class="block w-full text-[14px] font-medium border-slate-200 rounded-xl focus:ring-[#4f46e5] focus:border-[#4f46e5] bg-[#f8fafc] hover:bg-slate-100 shadow-sm px-4 py-3 appearance-none cursor-pointer transition-all text-slate-700">
                                    <option value="">No Category</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                            <p class="mt-2 text-[12px] font-medium text-slate-400">Optional. Organise your expense by linking it to a category.</p>
                            @else
                            <div class="rounded-[16px] border-2 border-dashed border-[#eef2ff] bg-[#eef2ff]/30 px-6 py-8 text-center transition-all hover:bg-[#eef2ff]/50">
                                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-[12px] bg-[#eef2ff] mb-4">
                                    <svg class="h-6 w-6 text-[#4f46e5]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                </div>
                                <h3 class="text-sm font-bold text-slate-900 mb-1">Create your first category</h3>
                                <p class="text-[13px] font-medium text-slate-500 mb-5 max-w-sm mx-auto">Categories help you track where your money goes. Add one to get started.</p>
                                <a href="{{ route('colocations.categories.index', $colocation) }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#4f46e5] text-white hover:bg-indigo-700 rounded-xl text-sm font-semibold transition-colors shadow-sm focus:ring-2 focus:ring-offset-2 focus:ring-[#4f46e5]">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    Add a Category
                                </a>
                            </div>
                            @endif
                        </div>

                        <div>
                            <label for="paid_by" class="block text-sm font-medium text-slate-700 mb-1.5">
                                Who Paid? <span class="text-red-500">*</span>
                            </label>
                            <select name="paid_by" id="paid_by" required class="block w-full text-sm border-slate-300 rounded-lg focus:ring-slate-900 focus:border-slate-900 shadow-sm px-3 py-2 transition-colors bg-white">
                                @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('paid_by', Auth::id()) == $user->id ? 'selected' : '' }}>
                                    {{ $user->id === Auth::id() ? 'You (' . $user->name . ')' : $user->name }}
                                </option>
                                @endforeach
                            </select>
                            <p class="mt-1.5 text-[12px] text-slate-400">Select the member who made the payment.</p>
                        </div>

                        <div class="flex items-center justify-end pt-5 mt-2 gap-3 border-t border-slate-100">
                            <a href="{{ route('colocations.show', $colocation) }}"
                                class="inline-flex justify-center items-center px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 hover:text-slate-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-200 transition-colors">
                                Cancel
                            </a>
                            <button type="submit"
                                class="inline-flex justify-center items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-slate-900 border border-transparent rounded-lg hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-900 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Add Expense
                            </button>
                        </div>
                    </form>

                </div>
            </div>

            <div class="mt-4 text-center">
                <p class="text-sm text-slate-500">
                    The expense will be split equally among all active members.
                </p>
            </div>
        </div>
    </div>
</x-app-layout>