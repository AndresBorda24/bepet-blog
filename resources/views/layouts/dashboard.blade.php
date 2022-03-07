<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        @livewireStyles

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-slate-200">
            @include('layouts.navigation')
            
            {{-- sub - Navegation  --}}
            <div class="flex justify-center w-full bg-slate-800 text-slate-100 space-x-4">
                <x-dash-nav-link route="dashboard.home">My Posts</x-dash-nav-link>
                <x-dash-nav-link route="dashboard.post.drafts">My Drafts</x-dash-nav-link>

                @if (auth()->user()->isAdmin())

                    @can('viewAny', \App\Models\Post::class)
                        <x-dash-nav-link route="dashboard.admin.posts">All Posts</x-dash-nav-link>
                    @endcan

                    <x-dash-nav-link route="dashboard.admin.categories.index" routeIs="dashboard.admin.categories.*">Categories</x-dash-nav-link>

                    <a href="" 
                        class="inline-block text-xs p-3 border-b-2 border-transparent hover:border-gray-400 hover:text-gray-400"
                    >Tags</a>
                    
                    <a href="" 
                        class="inline-block text-xs p-3 border-b-2 border-transparent hover:border-gray-400 hover:text-gray-400"
                    >Users</a>
                @endif
            </div>

            <!-- Page Heading -->
            <header class="">
                <div class="text-center p-1 mb-2 py-2 bg-slate-900 w-3/4 mx-auto rounded-b-full shadow-md shadow-black/50">
                    <h2 class="text-md text-slate-200">
                        {{ $header }}
                    </h2>
                </div>
            </header>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        {{-- page footer --}}
        <footer class="bg-slate-900 p-2">
            <h4 class="text-center text-gray-400 text-sm">Blog Bepet-Laravel -- 2022</h4>
        </footer>

        {{ $scripts ?? ''}}
        @livewireScripts
        <script>
            var search;
            var href;

            function getSearch(){
                search = document.getElementById('search').value;
                document.getElementById('linkSearch').href = "{{ route('post.search', 'yxy') }}".replace("yxy", search.trim());
                console.log(href);
            }
        </script>
    </body>
</html>
