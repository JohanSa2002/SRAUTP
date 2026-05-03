<x-app-layout>
    <x-slot name="header">
        {{ __('Panel de Control') }}
    </x-slot>

    <div class="space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-1000">
        <!-- Welcome Section -->
        <div class="glass-card rounded-[2.5rem] p-8 md:p-12 relative overflow-hidden">
            <div class="absolute top-0 right-0 -mt-20 -mr-20 w-80 h-80 bg-cyber-purple-500/10 rounded-full blur-3xl">
            </div>
            <div class="relative z-10 flex flex-col md:flex-row justify-between items-center">
                <div class="text-center md:text-left">
                    <h2 class="text-3xl md:text-5xl font-bold text-gray-900 leading-tight">
                        @if(Auth::user()->is_advisor_assistant)
                            Bienvenido, asistente del asesor <span class="tech-gradient-text">{{ Auth::user()->parentAdvisor->name }}</span>
                        @else
                            ¡Hola de nuevo, <span class="tech-gradient-text">{{ Auth::user()->name }}</span>!
                        @endif
                    </h2>
                    <p class="mt-4 text-lg text-gray-500 max-w-xl">
                        Bienvenido a tu ecosistema de investigación. Hoy es un excelente día para avanzar en la frontera
                        del conocimiento científico.
                    </p>
                </div>
                <div class="mt-12 md:mt-0 relative hidden lg:block">
                    <div
                        class="w-48 h-48 bg-gradient-to-tr from-cyber-purple-500 to-indigo-600 rounded-[3rem] rotate-12 shadow-2xl flex items-center justify-center">
                        <svg class="w-24 h-24 text-white -rotate-12" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.989-2.386l-.548-.547z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Access Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="glass-card p-8 rounded-[2.5rem] hover:bg-white hover:shadow-2xl hover:shadow-cyber-purple-500/10 transition-all duration-500 cursor-pointer group flex flex-col items-center text-center border-2 border-transparent hover:border-cyber-purple-100"
                onclick="window.location.href='{{ Auth::user()->is_admin ? route('admin.articles') : route('articles.index') }}'">
                <div
                    class="w-16 h-16 bg-purple-50 text-cyber-purple-600 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 group-hover:bg-cyber-purple-600 group-hover:text-white transition-all duration-500 shadow-inner">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <h4 class="text-xl font-black text-gray-900 uppercase tracking-tighter">{{ Auth::user()->is_admin ? 'Gestión' : 'Artículos' }}</h4>
                <p class="text-xs text-gray-500 mt-1 font-medium leading-tight">Investigaciones</p>
            </div>

            <div class="glass-card p-8 rounded-[2.5rem] hover:bg-white hover:shadow-2xl hover:shadow-cyber-purple-500/10 transition-all duration-500 cursor-pointer group flex flex-col items-center text-center border-2 border-transparent hover:border-cyber-purple-100"
                onclick="window.location.href='{{ route('events.index') }}'">
                <div
                    class="w-16 h-16 bg-orange-50 text-orange-600 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 group-hover:bg-orange-600 group-hover:text-white transition-all duration-500 shadow-inner">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <h4 class="text-xl font-black text-gray-900 uppercase tracking-tighter">Eventos</h4>
                <p class="text-xs text-gray-500 mt-1 font-medium leading-tight">Concursos y ferias</p>
            </div>

            <div class="glass-card p-8 rounded-[2.5rem] hover:bg-white hover:shadow-2xl hover:shadow-cyber-purple-500/10 transition-all duration-500 cursor-pointer group flex flex-col items-center text-center border-2 border-transparent hover:border-cyber-purple-100"
                onclick="window.location.href='{{ route('library.index') }}'">
                <div
                    class="w-16 h-16 bg-pink-50 text-pink-600 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 group-hover:bg-pink-600 group-hover:text-white transition-all duration-500 shadow-inner">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <h4 class="text-xl font-black text-gray-900 uppercase tracking-tighter">Librería</h4>
                <p class="text-xs text-gray-500 mt-1 font-medium leading-tight">Recursos oficiales</p>
            </div>
        </div>

    </div>
</x-app-layout>