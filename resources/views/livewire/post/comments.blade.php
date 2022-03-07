<div>
    @auth
        <livewire:post.create-comments :commented-post="$post_id"/>
    @endauth

    @foreach ($comms as $comment)
        <div class="my-4">
            <x-comment :comment="$comment" />

            @foreach ($comment->replies as $reply)
                <div class="w-4/5 ml-auto">
                    <x-comment :comment="$reply" />
                </div>
            @endforeach
        </div>
    @endforeach
</div>
