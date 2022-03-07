<nav x-data="{ open: false }" class="bg-slate-900 border-b border-slate-900">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-gray-200" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-4 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('Home') }}
                    </x-nav-link>
                    @auth
                        <x-nav-link :href="route('dashboard.home')" :active="request()->routeIs('dashboard.*')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                    @endauth
                </div>
            </div>
            <div class="flex grow pl-6 pr-2 items-center">
                <div class="flex grow flex-row items-center gap-1">
                    {{-- <form action="" id="linkSearch" class="w-full">
                        <div class="flex grow flex-row gap-1">
                            <input class="p-2 text-sm rounded border-transparent bg-slate-800 text-gray-500 block mt-1 w-full focus:bg-gray-300 focus:text-gray-700" type="text" name="search" id="search" onchange="getSearch()">
                            <x-button >
                                Search
                            </x-button>
                        </div>
                    </form> --}}

                    <input class="p-2 text-sm rounded border-transparent bg-slate-800 text-gray-500 block mt-1 w-full focus:bg-gray-300 focus:text-gray-700" type="text" name="search" id="search" onchange="getSearch()" autocomplete="off">
                    
                    <a id="linkSearch" href="" class="inline-block items-center px-4 py-2 bg-slate-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-slate-700 active:bg-slate-900 focus:outline-none focus:border-slate-900 focus:ring ring-slate-300 disabled:opacity-25 transition ease-in-out duration-150">{{ __('Search')}}</a>

                </div>
            </div>
            <!-- Settings Dropdown -->
            @auth
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-200 hover:text-gray-400 hover:border-gray-300 focus:outline-none focus:text-gray-400 focus:border-gray-300 transition duration-150 ease-in-out">
                            <x-user-avatar class="rounded-full w-8 h-auto mr-1 shadow-sm shadow-black"/>
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('home')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('dashboard.home')">
                            {{ __('Dashboard') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
            @endauth
            @guest
            <div class="hidden sm:flex sm:items-center sm:ml-6 space-x-2">
                <a href="{{ route('register') }}" class="p-2 rounded text-sm duration-300 text-blue-300 hover:text-blue-600 hover:border-blue-600 hover:shadow-md hover:shadow-slate-700/70">Write Your Post!</a>
                <a href="{{ route('login') }}" class="p-2 text-sm text-lime-500 border border-lime-500 rounded duration-300 hover:shadow-lg hover:shadow-slate-700 hover:text-slate-900 hover:bg-lime-500">Log in</a>
            </div>
            @endguest

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->     
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('Home') }}
            </x-responsive-nav-link>
            @auth
                <x-responsive-nav-link :href="route('dashboard.home')" :active="request()->routeIs('dashboard.*')">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
            @endauth
        </div>

        <!-- Responsive Settings Options -->
        @auth
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-dropdown-link :href="route('home')">
                    {{ __('Profile') }}
                </x-dropdown-link>
                <x-dropdown-link :href="route('dashboard.home')">
                    {{ __('Dashboard') }}
                </x-dropdown-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>

            </div>
        </div>
        @endauth
        @guest
            <div class="pt-4 px-2 flex flex-row justify-between pb-2 border-t border-emerald-700">
                <a href="{{ route('register') }}" class="p-2 text-sm text-cyan-600 border border-cyan-600 rounded duration-300 focus:text-slate-900 focus:bg-cyan-500">Write Your Post!</a>
                <a href="{{ route('login') }}" class="p-2 text-sm text-lime-500 border border-lime-500 rounded duration-300 focus:text-slate-900 focus:bg-lime-500">Log in</a>
            </div>
        @endguest
    </div>
</nav>
