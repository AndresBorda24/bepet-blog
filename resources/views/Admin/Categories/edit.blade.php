<x-dashboard >
    <x-slot name="header">
        {{ __('Edit Category') }}
    </x-slot>

    <div class="px-2 py-2 sm:px-0 md:py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-14 py-4 bg-slate-100 shadow-md">
                    <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('dashboard.admin.categories.update', $category) }}" autocomplete="off">
                @method('PUT')
                @csrf

                <!-- Category Name -->
                <div>
                    <x-label for="name" :value="__('Name Of Category')" />

                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name') ?? $category->name" required autofocus />
                </div>

                <div class="flex items-center justify-between mt-4">
                    <a href="{{ route('dashboard.admin.categories.index')}}" class="inline-block items-center px-4 py-2 bg-sky-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-sky-700 active:bg-sky-900 focus:outline-none focus:border-sky-900 focus:ring ring-sky-300 disabled:opacity-25 transition ease-in-out duration-150">{{ __('Back')}}</a>

                    <x-button class="ml-3">
                        {{ __('Edit') }}
                    </x-button>
                </div>
            </form>

        </div>
    </div>
</x-dashboard >