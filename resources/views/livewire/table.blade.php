<div>
    <div class="max-w-6xl mx-auto p-3">
        <div class="rounded max-w-fit w-max mx-auto">            
            <table class="table-auto max-w-max">
                <thead>
                    <tr class="bg-gray-800 text-sky-300 text-left border border-gray-800 rounded">
                        <x-table.table-titles :fields="$fields" :order="$orderBy" :dir="$direction"/>
                        <th class="py-3 px-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($filters)
                        <x-table.table-filters :filters="$filters"/>
                    @endif

                    @foreach ($records as $record)
                        <tr class=" even:bg-gray-600 odd:bg-gray-700 hover:bg-gray-500 text-zinc-100">
                            @foreach (array_keys($props) as $field)
                                <td class="p-2 border border-gray-900 text-sm">{{ $record->$field }}</td>
                            @endforeach

                            {{-- Actions --}}
                            <x-table.table-actions :route="$route" :record="$record" />
                        </tr>                    
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="{{ count($tableFields)+1 }}" class="p-2 text-center italic text-sm bg-gray-300 border border-gray-500 rounded-b">
                            @if (strlen($records->links()) > 20)
                                {{$records->links()}}
                            @else
                                Displaying all records
                            @endif
                        </td>            
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
