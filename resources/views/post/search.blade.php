<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg text-slate-700 leading-tight">
            {{ __('Posts by: ') }} {{ $searchBy }}
        </h2>
    </x-slot>

    <div class="px-2 py-6 sm:px-0 md:py-12">
        <div class="flex flex-col gap-4 max-w-3xl mx-auto sm:px-6 lg:px-8">
            @foreach ($posts as $post)
                <x-post-slab :post="$post" />
            @endforeach

            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>
