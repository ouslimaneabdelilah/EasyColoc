<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('colocations.show', $colocation) }}" class="text-gray-400 hover:text-gray-900 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            Manage Categories
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-extrabold text-[#111827]">Categories for {{ $colocation->name }}</h1>
            <p class="text-[14px] text-gray-500 mt-2 font-medium">Create and manage categories to organize the shared expenses effectively.</p>
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
            <!-- Left: List -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-[16px] border border-gray-100 shadow-sm overflow-hidden h-full">
                    <div class="px-8 py-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                        <h3 class="text-lg font-bold text-gray-900">Existing Categories</h3>
                        <span class="bg-[#eef2ff] text-[#4f46e5] py-1 px-3 rounded-md text-[11px] font-bold">{{ $categories->count() }} TOTAL</span>
                    </div>

                    @if($categories->isEmpty())
                    <div class="p-12 text-center">
                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-[16px] bg-[#eef2ff] mb-4">
                            <svg class="h-8 w-8 text-[#4f46e5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                        </div>
                        <h3 class="text-[16px] font-bold text-slate-900 mb-1">No categories yet</h3>
                        <p class="text-[14px] text-slate-500 max-w-sm mx-auto">Get started by adding your first category to better track expenses like "Groceries" or "Internet".</p>
                    </div>
                    @else
                    <ul class="divide-y divide-gray-100 p-2">
                        @foreach($categories as $category)
                        <li class="px-6 py-5 flex items-center justify-between hover:bg-gray-50 rounded-xl transition-colors group">
                            <div class="flex items-center gap-4">
                                <div class="flex items-center justify-center w-10 h-10 rounded-lg shadow-sm border border-black/5" style="background-color: {{ $category->color }}20;">
                                    <div class="w-4 h-4 rounded-full shadow-sm" style="background-color: {{ $category->color }};"></div>
                                </div>
                                <span class="text-[15px] font-bold text-gray-900">{{ $category->name }}</span>
                            </div>

                            @if($isOwner)
                            <div class="flex items-center sm:opacity-0 group-hover:opacity-100 transition-opacity">
                                <form action="{{ route('colocations.categories.destroy', [$colocation, $category]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-4 py-2 text-[13px] font-semibold text-red-600 bg-red-50 hover:bg-red-100 rounded-lg transition-colors border border-red-100 flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        Delete
                                    </button>
                                </form>
                            </div>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white rounded-[16px] border border-gray-100 shadow-sm overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-100 bg-gray-50/50">
                        <h3 class="text-[15px] font-bold text-gray-900">Add New Category</h3>
                    </div>
                    <div class="p-6">
                        <form action="{{ route('colocations.categories.store', $colocation) }}" method="POST" class="space-y-5">
                            @csrf
                            <div>
                                <label for="name" class="block text-[13px] font-bold text-gray-700 mb-1.5">Category Name <span class="text-red-500">*</span></label>
                                <input type="text" name="name" id="name" placeholder="e.g. Groceries" required
                                    class="block w-full text-sm border-gray-200 rounded-xl focus:ring-[#4f46e5] focus:border-[#4f46e5] shadow-sm px-4 py-2.5 transition-colors">
                            </div>

                            <div>
                                <label for="color" class="block text-[13px] font-bold text-gray-700 mb-1.5">Color Tag <span class="text-red-500">*</span></label>
                                <div class="flex items-center gap-3">
                                    <div class="relative overflow-hidden rounded-lg w-10 h-10 border border-gray-200 shadow-sm shrink-0 focus-within:ring-2 focus-within:ring-[#4f46e5] focus-within:ring-offset-1">
                                        <input type="color" name="color" id="color" value="#4f46e5" required
                                            class="absolute -top-2 -left-2 w-16 h-16 cursor-pointer">
                                    </div>
                                    <p class="text-[12px] font-medium text-gray-500 leading-tight">Pick a distinct color to easily identify this category.</p>
                                </div>
                            </div>

                            <button type="submit" class="w-full flex justify-center items-center gap-2 py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-[#4f46e5] hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#4f46e5] transition-colors mt-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Save Category
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>