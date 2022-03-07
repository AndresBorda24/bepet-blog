
@props(['filters'])

<tr class="bg-gray-700">

    @foreach ($filters as $filter => $opt)
        <td class="px-3 border border-gray-900">
            
            @switch($opt['type'] ?? '-')
                @case('text')
                    <x-table.filters.text :text-filter="$filter" />
                    @break
                
                @case('select')
                    <x-table.filters.select :select-filter="$filter" :options="$opt" />
                    @break
               
                @default
                    <x-table.filters.text :text-filter="$filter" />
            @endswitch 

        </td>             
    @endforeach

    <td colspan="2" class="border border-gray-900">
        <button wire:click="resetFilters()" class="block p-2 mx-auto rounded bg-green-600 text-white hover:bg-green-800 focus:ring ring-green-300 focus:bg-green-800 transition-all ease-out duration-150">Reset</button>
    </td>

</tr>
