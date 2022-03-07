<div>
    <div class="w-full p-1 mb-4">
        <form wire:submit.prevent="createComment" method="post">
            <x-form-error field-name="body" />
            <textarea wire:model.debounce.500ms="body" class="w-full resize-y text-sm rounded"></textarea>
            <x-button >
                Comment
            </x-button>
        </form>
    </div>
</div>
