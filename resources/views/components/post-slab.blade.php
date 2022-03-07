@props(['post'])
<a href="{{ route('post.show', $post) }}" class="block">

<div class="group grid grid-cols-1 h-auto bg-slate-100 hover:bg-slate-800 rounded-md transition-all duration-100 overflow-hidden shadow-md shadow-gray-700/40 hover:relative hover:bottom-1 hover:shadow-lg hover:shadow-gray-900/40  sm:grid-cols-3 cursor-pointer">
    <div class="max-h-24 sm:max-h-full p-2 brightness-75 duration-300 group-hover:brightness-100">
            <img src="{{ Storage::url($post->cover->link) }}" class="rounded-md" style="height: 100%; width: 100%; object-fit: cover; " alt="cover-post-{{$post->id}}">
    </div>
    <div class="p-4 sm:col-span-2">
        {{-- titulo del post --}}
        <h3 class="text-lg text-gray-800 group-hover:text-gray-200 hover:text-black">{{$post->title}}</h3>

        {{-- Extracto --}}
        <div class="text-sm py-3 text-gray-600 group-hover:text-gray-400">
            {!! $post->extract !!}
        </div>
        
        {{-- Extra info --}}
        <p class="text-sm group-hover:text-gray-400">Total Comments: <span class="text-red-400">{{$post->comments_count}}</span></p>
        <p class="text-sm group-hover:text-gray-400">By: <span class="text-red-400">{{$post->author->name}}</span></p>

        {{-- Tags --}}
        @foreach ($post->tags as $tag)
            <span class="text-blue-600 text-xs">#{{$tag->name}}  </span>
        @endforeach
    </div>
</div>
</a>
