@props(['post'])

<div class="flex items-center rounded my-2 bg-zinc-200 text-zinc-500 p-2 hover:bg-slate-300 hover:shadow-sm hover:shadow-black/60">
    <div class="flex-grow">
        <a href="{{ route('post.show', $post) }}">
            {{ $post->title }}
        </a>
    </div>
    <div>
        <div class="inline-block">
            <form method="POST" action="{{ route('dashboard.post.destroy', $post) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150" onclick=" return confirmDelete()">
                    {{ __('Delete') }}
                </button>
            </form>
        </div>
        
        <a href="{{ route('dashboard.post.edit', $post)}}" class="inline-flex items-center px-4 py-2 bg-sky-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-sky-700 active:bg-sky-900 focus:outline-none focus:border-sky-900 focus:ring ring-sky-300 disabled:opacity-25 transition ease-in-out duration-150">{{ __('Edit')}}</a>
        
        <a href="{{ route('dashboard.post.postIt', $post)}}" class="inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">{{ __('Post It')}}</a>

    </div>
</div>