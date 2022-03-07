<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? 'Laravel' }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        {{-- livewire --}}
        @livewireStyles

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="https://cdn.ckeditor.com/ckeditor5/32.0.0/classic/ckeditor.js"></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-slate-200">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-slate-100 shadow">
                <div class="max-w-7xl text-center mx-auto py-4 px-4 sm:px-6 lg:px-8">
                    {{ $header ?? 'Blog Burogu' }}
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
 

        @livewireScripts
        {{ $scripts ?? ''}}
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
