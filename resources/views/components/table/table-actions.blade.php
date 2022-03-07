@props(['route', 'record'])
<td class="py-1 px-4 border border-gray-900">
    <x-dropdown align="center">
        <x-slot name="trigger">
            <x-button type="button">
                Actions
            </x-button>
        </x-slot>

        <x-slot name="content">
            <x-dropdown-link :href="route($route.'edit', $record)" >
                Edit
            </x-dropdown-link>

            <form method="POST" action="{{ route($route."destroy", $record) }}" class="w-full">
                @csrf
                @method('DELETE')

                <x-dropdown-link :href="route($route.'edit', $record)" class="bg-red-200 text-gray-600 hover:text-gray-200 hover:bg-red-800"
                        onclick="confirmDelete();
                                event.preventDefault();
                                this.closest('form').submit();">
                    Delete
                </x-dropdown-link>
            </form>
        </x-slot>
    </x-dropdown>
</td>

{{-- <td class="p-2 border border-gray-900 text-center">
    <a href="{{ route($route.'edit', $record) }}" title="Editar" class="py-1 px-2 text-sm rounded text-gray-200 bg-blue-600 shadow-sm shadow-slate-900/30 hover:bg-blue-700">Edit</a>
</td>

<td class="p-2 border border-gray-900 text-center">
    <form method="POST" action="{{ route($route."destroy", $record) }}" class="w-full">
        @csrf
        @method('DELETE')
        <button type="submit" value="Delete" class="py-1 px-2 text-sm rounded text-gray-200 cursor-pointer bg-red-500 hover:bg-red-600"  onclick="return confirmDelete()">
            Delete
        </button>
    </form>
</td> --}}