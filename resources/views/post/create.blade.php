<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg text-slate-700 leading-tight">
            {{ __('My Posts') }}
        </h2>
    </x-slot>

    <div class="px-2 py-4 sm:px-0 md:py-12">

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-14 py-4 bg-slate-100 shadow-md">
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            @if (\Session::has('success'))
                <div class="bg-green-500 p-3 text-gray-200 text-center">
                    {!! \Session::get('success') !!}
                </div>
            @endif

            <form method="POST" action="{{ route('dashboard.post.store') }}" enctype="multipart/form-data">
                @csrf

                <!-- Post title -->
                <div>
                    <x-label for="title" :value="__('Title')" />

                    <x-input id="email" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
                </div>

                <div class="flex items-center">
                     <!-- Post tags -->
                    <div class="mt-4 basis-1/2">
                        <x-label for="tags" :value="__('Tags')" />

                        <div class="grid grid-cols-3">
                            @foreach ($tags as $tag)
                                <div class="px-2 py-1 inline-block">
                                    <input type="checkbox" name="tags[]" value="{{ $tag->id }}" class="cursor-pointer">
                                    <span class="text-blue-600 text-sm">#{{ $tag->name }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Post Categories -->
                    <div class="mt-4 basis-1/2">
                        <x-label for="categories" :value="__('Select a Category')" />

                        <select name="category_id" id="" class="block w-full">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
               

                <!-- Post Extract -->
                <div class="mt-4">
                    <x-label for="extract" :value="__('Extract')" />

                    <textarea name="extract" id="postExtract" class="block mt-1 w-full">{{ old('extract') }}</textarea>
                </div>

                <!-- Post Body -->
                <div class="mt-4">
                    <x-label for="body" :value="__('Body')" />

                    <textarea name="body" id="postBody" class="block mt-1 w-full">{{ old('body') }}</textarea>
                </div>

                <div class="mt-4">
                    <x-label for="cover" :value="__('Upload your cover')" />

                    <input type="file" name="cover" accept="image/png, image/jpeg" class="block w-full text-sm text-slate-500 file:cursor-pointer file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-200 file:text-green-700 hover:file:bg-green-300" required>
                </div>

                <div class="flex items-center justify-between mt-6">
                    <a href="{{ route('dashboard.home')}}" class="inline-flex items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150">{{ __('Cancel')}}</a>

                    <x-button class="ml-3">
                        {{ __('Save draft') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>


    <x-slot name="scripts">
        <script>
            ClassicEditor
                .create( document.querySelector( '#postExtract' ) )
                .then( editor => {
                        console.log( editor );
                } )
                .catch( error => {
                        console.error( error );
                } );

            ClassicEditor
                .create( document.querySelector( '#postBody' ) )
                .then( editor => {
                        console.log( editor );
                } )
                .catch( error => {
                        console.error( error );
                } );
        </script>
    </x-slot>
</x-app-layout>
