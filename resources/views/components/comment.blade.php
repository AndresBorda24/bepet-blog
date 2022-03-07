@props(['comment'])
<div class="p-2 my-2 bg-slate-300 rounded text-zinc-600 shadow-sm shadow-black/40">
    <div class="flex py-1 items-center">
        <div>
            <x-user-avatar :link="$comment->user->avatar->link" class="rounded-full w-6 h-auto mr-1 shadow-sm shadow-black"/>
        </div>
        <span class="text-md">{{ $comment->user->name }}</span>
    </div>
    <q class="text-sm">{{$comment->body}}</q>
    <p class="text-right text-xs text-zinc-500"> {{ $comment->created_at }}</p>
</div>