<nav x-data="{ open: false, scrolled: false }"
     x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 8 }, { passive: true })"
     :class="scrolled ? 'shadow-lg shadow-uni-navy-950/30' : ''"
     class="bg-uni-navy-900 sticky top-0 z-[60] border-b border-uni-gold-500/10 transition-shadow duration-300">

    <!-- Gold accent line at very top -->
    <div class="h-0.5 bg-gradient-to-r from-transparent via-uni-gold-500/50 to-transparent"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            <!-- ── Logo ───────────────────────────────────── -->
            <div class="shrink-0 flex items-center">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
                    <div class="relative">
                        <div class="w-9 h-9 bg-uni-gold-400 rounded-lg flex items-center justify-center
                                    shadow-md shadow-uni-gold-400/20
                                    group-hover:bg-uni-gold-300 transition-colors duration-200">
                            <svg class="w-5 h-5 text-uni-navy-950" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="hidden md:block leading-none">
                        <span class="font-serif font-bold text-lg text-white">UTP</span>
                        <span class="font-serif font-bold text-lg text-uni-gold-400"> Académico</span>
                    </div>
                </a>
            </div>

            <!-- ── Primary nav links ──────────────────────── -->
            <div class="hidden space-x-1 sm:-my-px sm:ms-8 sm:flex items-center">

                <a href="{{ route('dashboard') }}"
                   @if(request()->routeIs('dashboard')) aria-current="page" @endif
                   class="nav-link-uni px-3 py-5 {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    Dashboard
                </a>

                @if(!Auth::user()->is_admin)
                    <a href="{{ route('articles.index') }}"
                       @if(request()->routeIs('articles.*')) aria-current="page" @endif
                       class="nav-link-uni px-3 py-5 {{ request()->routeIs('articles.*') ? 'active' : '' }}">
                        Artículos
                    </a>

                    <a href="{{ route('certificates.index') }}"
                       @if(request()->routeIs('certificates.*')) aria-current="page" @endif
                       class="nav-link-uni px-3 py-5 {{ request()->routeIs('certificates.*') ? 'active' : '' }}">
                        Certificados
                    </a>
                @endif

                <a href="{{ route('library.index') }}"
                   @if(request()->routeIs('library.*')) aria-current="page" @endif
                   class="nav-link-uni px-3 py-5 {{ request()->routeIs('library.*') ? 'active' : '' }}">
                    Librería
                </a>

                <a href="{{ route('events.index') }}"
                   @if(request()->routeIs('events.*')) aria-current="page" @endif
                   class="nav-link-uni px-3 py-5 {{ request()->routeIs('events.*') ? 'active' : '' }}">
                    Eventos
                </a>

                @if(Auth::user()->is_advisor)
                    <a href="{{ route('advisor.assistants.index') }}"
                       @if(request()->routeIs('advisor.assistants.*')) aria-current="page" @endif
                       class="nav-link-uni px-3 py-5 {{ request()->routeIs('advisor.assistants.*') ? 'active' : '' }}">
                        Mis Asistentes
                    </a>
                @endif

                @if(Auth::user()->is_admin)
                    <a href="{{ route('admin.users') }}"
                       @if(request()->routeIs('admin.users')) aria-current="page" @endif
                       class="nav-link-uni px-3 py-5 {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                        Usuarios
                    </a>
                    <a href="{{ route('admin.articles') }}"
                       @if(request()->routeIs('admin.articles')) aria-current="page" @endif
                       class="nav-link-uni px-3 py-5 {{ request()->routeIs('admin.articles') ? 'active' : '' }}">
                        Gestión Global
                    </a>
                    <a href="{{ route('admin.notices.index') }}"
                       @if(request()->routeIs('admin.notices.*')) aria-current="page" @endif
                       class="nav-link-uni px-3 py-5 {{ request()->routeIs('admin.notices.*') ? 'active' : '' }}">
                        Noticias
                    </a>
                @endif

            </div>

            <!-- ── User dropdown ─────────────────────────── -->
            <div class="hidden sm:flex sm:items-center sm:ms-4">
                <x-dropdown align="right" width="52">
                    <x-slot name="trigger">
                        <button aria-label="Menú de usuario" aria-haspopup="menu"
                                class="inline-flex items-center gap-2.5 px-3 py-1.5 min-h-[44px]
                                       bg-white/5 hover:bg-white/10 border border-white/10 hover:border-uni-gold-500/30
                                       rounded-xl text-sm font-medium text-white/80 hover:text-white
                                       transition-all duration-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-uni-gold-400 group">
                            <!-- Avatar -->
                            @if(Auth::user()->profile_photo_path)
                                <img src="{{ Storage::url(Auth::user()->profile_photo_path) }}"
                                     alt="{{ Auth::user()->name }}"
                                     class="h-7 w-7 rounded-full object-cover ring-1 ring-uni-gold-500/30">
                            @else
                                <div class="h-7 w-7 rounded-full bg-gradient-to-br from-uni-gold-400 to-uni-gold-600
                                            flex items-center justify-center text-uni-navy-950 font-bold text-xs">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                            @endif
                            <span class="hidden lg:block text-sm">{{ Auth::user()->name }}</span>
                            <svg class="h-3.5 w-3.5 text-white/40 group-hover:text-white/70 transition-colors"
                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Profile info header -->
                        <div class="px-4 py-3 border-b border-gray-100">
                            <p class="text-xs text-gray-400">Sesión activa</p>
                            <p class="text-sm font-semibold text-gray-800 truncate mt-0.5">{{ Auth::user()->email }}</p>
                        </div>

                        <x-dropdown-link :href="route('profile.edit')" class="flex items-center gap-2.5 !text-gray-700">
                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <span>Mi Perfil</span>
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('profile.settings')" class="flex items-center gap-2.5 !text-gray-700">
                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span>Configuración</span>
                        </x-dropdown-link>

                        <div class="border-t border-gray-100 mt-1" @click.stop>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="flex items-center gap-2.5 w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-red-50 transition-colors duration-150">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    <span>Cerrar Sesión</span>
                                </button>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- ── Hamburger (mobile) ─────────────────────── -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = !open"
                        :aria-expanded="open.toString()"
                        aria-controls="mobile-menu"
                        aria-label="Abrir menú de navegación"
                        class="inline-flex items-center justify-center p-2.5 min-w-[44px] min-h-[44px] rounded-xl
                               text-white/60 bg-white/5 border border-white/10
                               hover:bg-white/10 hover:text-white
                               focus:outline-none focus-visible:ring-2 focus-visible:ring-uni-gold-400 transition duration-200">
                    <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                        <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- ── Responsive Menu ───────────────────────────────── -->
    <div :class="{'block': open, 'hidden': !open}"
         id="mobile-menu"
         class="hidden sm:hidden bg-uni-navy-950/95 backdrop-blur-md border-t border-white/5">

        <div class="pt-2 pb-3 space-y-0.5 px-3">
            <a href="{{ route('dashboard') }}"
               class="block px-4 py-2.5 rounded-xl text-sm font-medium
                      {{ request()->routeIs('dashboard') ? 'bg-white/10 text-uni-gold-400' : 'text-white/70 hover:bg-white/5 hover:text-white' }}
                      transition-colors duration-150">
                Dashboard
            </a>
            @if(!Auth::user()->is_admin)
                <a href="{{ route('articles.index') }}"
                   class="block px-4 py-2.5 rounded-xl text-sm font-medium
                          {{ request()->routeIs('articles.*') ? 'bg-white/10 text-uni-gold-400' : 'text-white/70 hover:bg-white/5 hover:text-white' }}
                          transition-colors duration-150">
                    Artículos
                </a>
                <a href="{{ route('certificates.index') }}"
                   class="block px-4 py-2.5 rounded-xl text-sm font-medium
                          {{ request()->routeIs('certificates.*') ? 'bg-white/10 text-uni-gold-400' : 'text-white/70 hover:bg-white/5 hover:text-white' }}
                          transition-colors duration-150">
                    Certificados
                </a>
            @endif
            @if(Auth::user()->is_advisor)
                <a href="{{ route('advisor.assistants.index') }}"
                   class="block px-4 py-2.5 rounded-xl text-sm font-medium
                          {{ request()->routeIs('advisor.assistants.*') ? 'bg-white/10 text-uni-gold-400' : 'text-white/70 hover:bg-white/5 hover:text-white' }}
                          transition-colors duration-150">
                    Mis Asistentes
                </a>
            @endif
            @if(Auth::user()->is_admin)
                <a href="{{ route('admin.users') }}"
                   class="block px-4 py-2.5 rounded-xl text-sm font-medium
                          {{ request()->routeIs('admin.users') ? 'bg-white/10 text-uni-gold-400' : 'text-white/70 hover:bg-white/5 hover:text-white' }}
                          transition-colors duration-150">
                    Usuarios
                </a>
                <a href="{{ route('admin.articles') }}"
                   class="block px-4 py-2.5 rounded-xl text-sm font-medium
                          {{ request()->routeIs('admin.articles') ? 'bg-white/10 text-uni-gold-400' : 'text-white/70 hover:bg-white/5 hover:text-white' }}
                          transition-colors duration-150">
                    Gestión Global
                </a>
                <a href="{{ route('admin.notices.index') }}"
                   class="block px-4 py-2.5 rounded-xl text-sm font-medium
                          {{ request()->routeIs('admin.notices.*') ? 'bg-white/10 text-uni-gold-400' : 'text-white/70 hover:bg-white/5 hover:text-white' }}
                          transition-colors duration-150">
                    Noticias
                </a>
            @endif
            <a href="{{ route('library.index') }}"
               class="block px-4 py-2.5 rounded-xl text-sm font-medium
                      {{ request()->routeIs('library.*') ? 'bg-white/10 text-uni-gold-400' : 'text-white/70 hover:bg-white/5 hover:text-white' }}
                      transition-colors duration-150">
                Librería
            </a>
            <a href="{{ route('events.index') }}"
               class="block px-4 py-2.5 rounded-xl text-sm font-medium
                      {{ request()->routeIs('events.*') ? 'bg-white/10 text-uni-gold-400' : 'text-white/70 hover:bg-white/5 hover:text-white' }}
                      transition-colors duration-150">
                Eventos
            </a>
        </div>

        <!-- Mobile user info -->
        <div class="border-t border-white/5 pt-4 pb-3 px-3">
            <div class="flex items-center gap-3 px-4 mb-3">
                @if(Auth::user()->profile_photo_path)
                    <img src="{{ Storage::url(Auth::user()->profile_photo_path) }}"
                         alt="{{ Auth::user()->name }}"
                         class="h-10 w-10 rounded-full object-cover ring-2 ring-uni-gold-500/30">
                @else
                    <div class="h-10 w-10 rounded-full bg-gradient-to-br from-uni-gold-400 to-uni-gold-600
                                flex items-center justify-center text-uni-navy-950 font-bold">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                @endif
                <div>
                    <div class="font-semibold text-sm text-white">{{ Auth::user()->name }}</div>
                    <div class="text-xs text-white/40 truncate">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="space-y-0.5 px-0">
                <a href="{{ route('profile.edit') }}"
                   class="block px-4 py-2.5 rounded-xl text-sm text-white/70 hover:bg-white/5 hover:text-white transition-colors">
                    Mi Perfil
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="w-full text-left block px-4 py-2.5 rounded-xl text-sm text-red-400 hover:bg-red-500/10 transition-colors">
                        Cerrar Sesión
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
