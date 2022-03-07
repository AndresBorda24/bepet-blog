<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg text-slate-700 leading-tight">
            {{ __('Recent Posts') }}
        </h2>
    </x-slot>

    <div class="px-2 py-6 sm:px-0 md:py-12">
        <div class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-4 gap-0 max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="hidden md:flex md:flex-col md:p-3 md:relative">
                <div class="p-2 sticky top-1">
                    <div class="mt-8 mb-4 bg-slate-800 p-3 shadow-md shadow-black/30">
                        <h3 class="mb-2 text-md text-slate-200">Explore Categories</h3>
                        @foreach ($categories as $category)
                            <a href=" {{ route('post.search.category', $category) }}"><p class="p-1.5 my-2 text-sm text-slate-700 rounded-sm bg-slate-200 hover:bg-slate-300">{{$category->name}}</p></a>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="sm:col-span-2 flex flex-col gap-3 p-2 sm:p-4 sm:gap-y-8 ">
                @foreach ($posts as $post)
                    <x-post-slab :post="$post" />
                @endforeach
            </div>

            <div class="flex flex-col p-3 relative">
                <div class="sticky top-1">
                    <div class="mb-8">
                        <h3 class="text-lg">Some Comments: </h3>
                        @foreach ($comm as $com)
                            <div class="p-2 my-2 bg-slate-300 rounded-md">
                                <div class="flex items-center">
                                    <img src="{{'storage/'. $com->user->avatar->link}}" width="20px" class="rounded-full" alt="">
                                    <span class="pl-1 text-sm">{{$com->user->name}}</span>
                                </div>
                                <q class="text-xs p-2 italic">{{ $com->body }}</q>
                                <p class="text-xs py-2 text-blue-500"><a href="{{ route('post.show', $com->post_slug) }}">{{ $com->post_title }}</a></p>
                                <p class="text-xs text-right">{{ $com->created_at->format('d/m/Y')}}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
