<x-dashboard >
    <x-slot name="header">
        {{ __('My drafts') }}
    </x-slot>

    <div class="px-2 py-2 sm:px-0 md:py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-14 py-4 bg-slate-100 shadow-md">
            @if (\Session::has('success'))
                <div class="bg-green-400 mb-4 p-3 border-l-4 border-green-600 text-green-700 ">
                    {!! \Session::get('success') !!}
                </div>
            @endif

            @if (count($posts))
                @foreach ($posts as $post)
                    <x-draft-card :post="$post" />
                @endforeach
            @else
                <p>Parece que no hay nada que mostrar</p>
            @endif
        </div>
    </div>

    <x-slot name="scripts">
        <script>
        function confirmDelete()
            {
                var res = confirm("Eliminar?");

                if (res == true)
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
        </script>
    </x-slot>
</x-dashboard >
