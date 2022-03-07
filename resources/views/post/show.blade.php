<x-app-layout>
    <x-slot name="title">
        Blog -- {{ $post->title }}
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-lg text-slate-700 leading-tight">
            {{ $post->title }}
        </h2>
    </x-slot>
    <div class="relative pt-24 pb-10 md:pt-52 lg:pt-60">
        <div class="absolute w-full h-28 sm:h-40 md:h-96 top-0 bg-blue-600 z-10 overflow-hidden">
             <img src="{{ Storage::url($post->cover->link) }}" class="absolute object-cover h-full w-full brightness-50" alt="">
        </div>
    
        <div class="relative px-2 sm:px-0 md:py-12 z-20">

            @can('update', $post)
                <div class="flex justify-between max-w-7xl mx-auto p-4">
                    <a href="{{ route('dashboard.post.edit', $post)}}" class="inline-block items-center px-4 py-2 bg-orange-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-orange-700 active:bg-orange-900 focus:outline-none focus:border-orange-900 focus:ring ring-orange-300 disabled:opacity-25 transition ease-in-out duration-150">{{ __('Edit')}}</a>

                    @can('postIt', $post)
                        <a href="{{ route('dashboard.post.postIt', $post)}}" class="inline-block items-center px-4 py-2 bg-emerald-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-emerald-700 active:bg-emerald-900 focus:outline-none focus:border-emerald-900 focus:ring ring-emerald-300 disabled:opacity-25 transition ease-in-out duration-150">{{ __('Post It')}}</a>
                    @endcan
                </div>
            @endcan
            
            <div class="grid grid-cols-1 gap-3 md:grid-cols-3 lg:grid-cols-5 max-w-7xl mx-auto sm:px-6 lg:px-8">
                {{-- Post Body --}}
                <div class="p-4 rounded md:col-span-2 md:p-8 lg:p-12 lg:col-span-3 bg-slate-100 shadow-md shadow-black/60">
                    <div class="pb-2">
                        @foreach ($post->tags as $tag)
                            <span class="text-blue-600 text-xs">#{{$tag->name}}  </span>
                        @endforeach
                    </div>
                    {!! $post->body !!}
                </div>

                {{-- Post Data --}}
                <div class="md:row-span-2 flex flex-col md:relative gap-2 p-4 lg:col-span-2">
                    {{-- Summary --}}
                    <div class="md:sticky md:top-1 p-4 bg-zinc-800 rounded-md shadow-md shadow-black/60 text-zinc-400">
                        <h3 class="text-cyan-300 text-lg text-center">{{ $post->title }}</h3>

                        <div class="w-full py-3 h-40 lg:h-52 overflow-hidden">
                            <img src="{{ Storage::url($post->cover->link) }}" class="rounded-lg object-cover h-full w-full" alt="">
                        </div>

                        <ul class="list-disc list-inside text-sm">
                            <li class="py-2">
                                <span class="text-zinc-200">Author: </span> {{ $post->author->name }}
                            </li>
                            <li class="py-2">
                                <span class="text-zinc-200">Category: </span> {{ $post->category->name ?? 'No Category'}}
                            </li>
                            <li class="py-2">
                                <span class="text-zinc-200">Posted at: </span> {{ $post->posted_at ? date("jS F, Y", strtotime($post->posted_at)) : '' }}
                            </li>
                            <li class="py-2">
                                <span class="text-zinc-200">Extract: </span> {!! $post->extract !!}
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- comments --}}
                <div class="flex flex-col bg-slate-100 shadow-sm shadow-black/40 gap-4 mt-8 rounded p-2 md:col-span-2 md:p-8 lg:p-12 lg:col-span-3">
                    <h3 class="text-xl text-emerald-700">Comments</h3>
                   
                    <livewire:post.comments :post-id="$post->id"/>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
