<table class="table-auto rounded-sm border-collapse border-2 border-slate-900 mx-auto shadow-lg shadow-slate-900/40">

    {{-- Table Titles --}}
    <thead class="text-sm 2xl:text-base">
        <tr class="border-b-2 border-slate-900 bg-slate-900 text-gray-200">
        @foreach ($tableTitles as $tTitle)
            <th class="py-2 px-2">{{$tTitle}}</th>
        @endforeach
        <th colspan="2">Actions</th>
        </tr>
    </thead>

    {{-- Body --}}
    <tbody class="text-sm 2xl:text-base">
        @foreach ($list as $item)
        <tr class="odd:bg-gray-50 select-none even:bg-gray-200 hover:bg-slate-300">

            @foreach ($dataKeys as $key)
                @if ($key == 'title')
                    <td class="border border-slate-800 py-1 px-2"><a href="{{ route('post.show', $item)}}" class="text-gray-800 hover:text-red-700">{{ $item->$key }}</a></td>                    
                @else
                    @if ($key == 'status')
                        <td class="border border-slate-800 py-1 px-2  text-center">
                        @switch($item->$key)
                            @case('BORRADOR')
                                <span class="rounded p-1 bg-amber-300">Borrador</span></td>
                                @break
                            @case('PUBLICADO')
                                <span class="rounded p-1 bg-green-300">Publicado</span></td>
                                @break
                            @case('ARCHIVADO')
                                <span class="rounded p-1 bg-red-300">Archivado</span></td>
                                @break
                            @default
                        @endswitch
                    @else
                        <td class="border border-slate-800 py-1 px-2">{{ $item->$key }}</td>                
                    @endif
                @endif
            @endforeach

            {{-- Botón Eliminar --}}
            <td class="border border-slate-800 py-1 px-4 text-center">
                <form method="POST" action="{{ route($route."destroy", $item) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" value="Delete" class="'w-min py-1 px-2 rounded-md text-gray-200  cursor-pointer bg-red-500 hover:bg-red-600"  onclick="return confirmDelete()">
                        Delete
                    </button>
                </form>
            </td>

            {{-- Botón Editar --}}
            <td class="border border-slate-800 py-1 px-2 text-center">
                <a href="{{ route($route.'edit', $item) }}" title="Editar" class="mx-1 py-1 px-2 rounded-md text-gray-200 bg-blue-600 shadow-sm shadow-slate-900/30 hover:bg-blue-700">Edit</a>
            </td>
        </tr>
        @endforeach
        <tfoot class="border border-t-2 border-slate-900">
           <tr>
               <td colspan="{{ count($tableTitles) + 2}}" class="p-1 bg-slate-800 text-gray-200">{{ $list->links() }}</td>
           </tr>
        </tfoot>
    </tbody>
</table>
