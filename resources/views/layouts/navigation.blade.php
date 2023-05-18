@php
    use Illuminate\Support\Facades\Auth;
@endphp

<html>
    <head>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
        <link rel="stylesheet" href="{{ asset('css/edit_profile.css') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body>
        <header>
            <nav x-data="{ open: false }" class="bg-white white:bg-gray-800 border-b border-gray-100 white:border-gray-700 shadow-lg  w-full mb-4 cabecera">
            <!-- Primary Navigation Menu -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center">
                            <a href="{{ route('inicio') }}">
                                <img src="{{ asset ('images/logo.png')}}" alt ="logo" class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" style="height:60px;">

                            </a>
                        </div>

                        <!-- Navigation Links -->
                        <!-- <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                                {{ __('ArchiVault') }}
                            </x-nav-link>
                        </div> -->
                    </div>

                    <div class="hidden sm:flex sm:items-center sm:ml-6">

                        <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();"
                                class="inline-flex items-center px-3 py-2 border border-transparent text-lg leading-4 font-medium rounded-md text-gray-500 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    <span class="material-symbols-outlined">logout</span>
                                </a>
                        </form>

                        <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-3 py-2 border border-transparent text-lg leading-4 font-medium rounded-md text-gray-500 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>                
                            <span class="material-symbols-outlined">settings</span>
                            </div>
                        </a>

                  
                    </div>



                    <!-- Hamburger -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 white:text-gray-500 hover:text-gray-500 white:hover:text-gray-400 hover:bg-white-100 dark:hover:bg-white-900 focus:outline-none focus:bg-white-100 white:focus:bg-gray-900 focus:text-gray-500 white:focus:text-gray-400 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

      <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
                <div class="pt-4 pb-1 border-t border-gray-200 white:border-gray-600">
                    <div class="px-4">
                        <div class="font-medium text-base text-gray-800 white:text-gray-200">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <x-responsive-nav-link :href="route('profile.edit')">
                            {{ __('Perfil') }}
                        </x-responsive-nav-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-responsive-nav-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Cerrar sesión') }}
                            </x-responsive-nav-link>
                        </form>
                    </div>
                </div>
            </div> 
        </nav>
    </body>
</html>
