<nav x-data="{ open: false }"
    class="bg-white/60 backdrop-blur-lg border-b border-white/20 sticky top-0 z-[60] shadow-sm">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center group">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                        <div
                            class="bg-cyber-purple-500 p-2 rounded-xl shadow-lg shadow-cyber-purple-500/30 transition-transform group-hover:scale-110 duration-300">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <span class="font-bold text-xl tracking-tight text-cyber-dark-900 hidden md:block">UTP<span
                                class="text-cyber-purple-500">_ACADÉMICO</span></span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-4 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                        class="text-sm font-medium transition-colors hover:text-cyber-purple-600">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    @if(!Auth::user()->is_admin)
                    <x-nav-link :href="route('articles.index')" :active="request()->routeIs('articles.*')"
                        class="text-sm font-medium transition-colors hover:text-cyber-purple-600">
                        {{ __('Artículos') }}
                    </x-nav-link>
                    @endif
                    <x-nav-link :href="route('library.index')" :active="request()->routeIs('library.*')"
                        class="text-sm font-medium transition-colors hover:text-cyber-purple-600">
                        {{ __('Librería') }}
                    </x-nav-link>
                    <x-nav-link :href="route('events.index')" :active="request()->routeIs('events.*')"
                        class="text-sm font-medium transition-colors hover:text-cyber-purple-600">
                        {{ __('Eventos') }}
                    </x-nav-link>
                    @if(Auth::user()->is_advisor)
                        <x-nav-link :href="route('advisor.assistants.index')" :active="request()->routeIs('advisor.assistants.*')"
                            class="text-sm font-medium transition-colors hover:text-cyber-purple-600">
                            {{ __('Mis Asistentes') }}
                        </x-nav-link>
                    @endif
                    @if(Auth::user()->is_admin)
                        <x-nav-link :href="route('admin.users')" :active="request()->routeIs('admin.users')"
                            class="text-sm font-medium transition-colors hover:text-cyber-purple-600">
                            {{ __('Usuarios') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.articles')" :active="request()->routeIs('admin.articles')"
                            class="text-sm font-medium transition-colors hover:text-cyber-purple-600">
                            {{ __('Gestión Global') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.notices.index')" :active="request()->routeIs('admin.notices.*')"
                            class="text-sm font-medium transition-colors hover:text-cyber-purple-600">
                            {{ __('Noticias/Avisos') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center space-x-3 px-4 py-2 bg-white/50 backdrop-blur-sm border border-gray-100 rounded-2xl text-sm font-medium text-gray-700 hover:bg-white hover:shadow-md transition-all duration-300 focus:outline-none">
                            <div class="flex items-center">
                                @if(Auth::user()->profile_photo_path)
                                    <img src="{{ Storage::url(Auth::user()->profile_photo_path) }}" alt="{{ Auth::user()->name }}"
                                        class="h-8 w-8 rounded-full object-cover shadow-inner">
                                @else
                                    <div
                                        class="h-8 w-8 rounded-full bg-gradient-to-tr from-cyber-purple-500 to-indigo-600 flex items-center justify-center text-white font-bold text-xs shadow-inner">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </div>
                                @endif
                                <div class="hidden lg:block ml-3">{{ Auth::user()->name }}</div>
                            </div>
                            <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="flex items-center space-x-2">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span>{{ __('Mi Perfil') }}</span>
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('profile.settings')" class="flex items-center space-x-2">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>{{ __('Configuración') }}</span>
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                                class="text-red-500 flex items-center space-x-2">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                <span>{{ __('Cerrar Sesión') }}</span>
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2.5 rounded-xl text-gray-400 bg-white/50 backdrop-blur-sm border border-gray-100 hover:text-cyber-purple-600 focus:outline-none transition duration-300">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}"
        class="hidden sm:hidden bg-white/80 backdrop-blur-xl border-t border-gray-100">
        <div class="pt-2 pb-3 space-y-2 px-2">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="rounded-xl">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            @if(!Auth::user()->is_admin)
            <x-responsive-nav-link :href="route('articles.index')" :active="request()->routeIs('articles.*')" class="rounded-xl">
                {{ __('Artículos') }}
            </x-responsive-nav-link>
            @endif
            @if(Auth::user()->is_advisor)
                <x-responsive-nav-link :href="route('advisor.assistants.index')" :active="request()->routeIs('advisor.assistants.*')" class="rounded-xl">
                    {{ __('Mis Asistentes') }}
                </x-responsive-nav-link>
            @endif
            @if(Auth::user()->is_admin)
                <x-responsive-nav-link :href="route('admin.users')" :active="request()->routeIs('admin.users')" class="rounded-xl">
                    {{ __('Usuarios') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.articles')" :active="request()->routeIs('admin.articles')" class="rounded-xl">
                    {{ __('Gestión Global') }}
                </x-responsive-nav-link>
            @endif
            <x-responsive-nav-link :href="route('library.index')" :active="request()->routeIs('library.*')" class="rounded-xl">
                {{ __('Librería') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('events.index')" :active="request()->routeIs('events.*')" class="rounded-xl">
                {{ __('Eventos') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-100">
            <div class="px-4 flex items-center space-x-3">
                @if(Auth::user()->profile_photo_path)
                    <img src="{{ Storage::url(Auth::user()->profile_photo_path) }}" alt="{{ Auth::user()->name }}"
                        class="h-10 w-10 rounded-full object-cover shadow-sm">
                @else
                    <div
                        class="h-10 w-10 rounded-full bg-cyber-purple-500 flex items-center justify-center text-white font-bold">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                @endif
                <div>
                    <div class="font-bold text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1 px-2">
                <x-responsive-nav-link :href="route('profile.edit')" class="rounded-xl">
                    {{ __('Perfil') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                        class="rounded-xl text-red-500">
                        {{ __('Cerrar Sesión') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>