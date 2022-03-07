@props(['fields', 'order', 'dir'])

@foreach ($fields as $title => $value)

    @if ($value[1])
        <th wire:click="order('{{$value[0]}}')" class="px-4 py-3 cursor-pointer">{{ $title }}
            @if ($value[0] == $order)
                @if ($dir == 'asc')
                    <span class=" text-gray-50 pl-2"> ^</span>
                @else
                    <span class=" font-light text-gray-50 pl-2"> v</span>
                @endif
            @endif
        </th>
    @endif

@endforeach