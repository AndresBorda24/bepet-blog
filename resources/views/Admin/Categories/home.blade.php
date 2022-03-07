<x-dashboard >
    <x-slot name="header">
        {{ __('Categoriess') }}
    </x-slot>

    <div class="px-2 py-2 sm:px-0 md:py-6">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-14 py-4 bg-slate-100 shadow-md">

            @if (\Session::has('success'))
                <div class="bg-green-400 mb-4 p-3 border-l-4 border-green-600 text-green-700 ">
                    {!! \Session::get('success') !!}
                </div>
            @endif
            
            <div class="flex justify-end pb-3">
                <a href="{{ route('dashboard.admin.categories.create')}}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">{{ __('Create')}}</a>
            </div>

            <livewire:table 
                :filters="$filters"
                :table="$table"
                :fields="$fields"
                route="dashboard.admin.categories." />
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