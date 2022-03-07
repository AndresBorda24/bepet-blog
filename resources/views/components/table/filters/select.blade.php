@props(['selectFilter', 'options'])

<select name="{{$selectFilter}}" wire:model="{{"props.$selectFilter"}}">
    <option value="">All</option>

    @foreach ($options['options'] as $value => $option)
        <option value="{{$value}}">{{$option}}</option>
    @endforeach
</select>
