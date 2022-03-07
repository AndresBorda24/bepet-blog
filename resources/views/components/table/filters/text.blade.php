@props(['textFilter'])

<input 
    wire:model.debounce.550ms={{"props.$textFilter"}}
    type="text" 
    class="block w-full rounded-sm my-3 border-transparent outline-none bg-slate-400 text-slate-600 focus:bg-slate-300 focus:text-slate-700">