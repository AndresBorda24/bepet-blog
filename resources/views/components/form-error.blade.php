@props(['fieldName'])
@error($fieldName)
    <p class="text-xs text-red-500">{{ $message }}</p>
@enderror