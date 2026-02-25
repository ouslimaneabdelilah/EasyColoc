<x-app-layout>
    <x-slot name="header">
        Créer une colocation
    </x-slot>

    <div class="py-8">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-xl border border-slate-200/80">
                <div class="px-6 py-6 sm:p-8">

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-slate-900">Nouvelle Colocation</h3>
                        <p class="mt-1 text-sm text-slate-500">
                            Créez votre espace pour commencer à inviter vos colocataires.
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

                    <form method="POST" action="{{ route('colocations.store') }}" class="space-y-4">
                        @csrf

                        <div>
                            <label for="name" class="block text-sm font-medium text-slate-700 mb-1.5">
                                Nom de la colocation <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="name" id="name" required
                                class="block w-full text-sm border-slate-300 rounded-lg focus:ring-slate-900 focus:border-slate-900 shadow-sm px-3 py-2 transition-colors"
                                placeholder="Ex: Appartement 4A"
                                value="{{ old('name') }}">
                            @error('name')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center justify-end pt-4 mt-6 gap-3">
                            <a href="{{ route('colocations.index') }}"
                                class="inline-flex justify-center items-center px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 hover:text-slate-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-200 transition-colors">
                                Annuler
                            </a>
                            <button type="submit"
                                class="inline-flex justify-center items-center px-4 py-2 text-sm font-medium text-white bg-slate-900 border border-transparent rounded-lg hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-900 transition-colors">
                                Créer
                            </button>
                        </div>
                    </form>

                </div>
            </div>

            <div class="mt-4 text-center">
                <p class="text-sm text-slate-500">
                    Vous deviendrez automatiquement l'administrateur de cette colocation.
                </p>
            </div>
        </div>
    </div>
</x-app-layout>