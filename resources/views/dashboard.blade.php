<x-app-layout>
    <x-slot name="header">
        {{ __('Panel de Control') }}
    </x-slot>

    <div class="space-y-10">
        <!-- Welcome Section -->
        <section class="hero-academic rounded-3xl p-8 md:p-12 relative overflow-hidden animate-fade-in-up"
                 aria-labelledby="welcome-heading">
            <div class="absolute inset-0 hero-academic-pattern" aria-hidden="true"></div>
            <div class="absolute top-0 right-0 -mt-24 -mr-24 w-96 h-96 bg-uni-gold-400/10 rounded-full blur-3xl" aria-hidden="true"></div>

            <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-8">
                <div class="text-center md:text-left">
                    <p class="academic-label text-uni-gold-300/90">Ecosistema de investigación</p>
                    <h2 id="welcome-heading" class="academic-heading text-3xl md:text-5xl font-bold text-white mt-3">
                        @if(Auth::user()->is_advisor_assistant)
                            Bienvenido, asistente de <span class="text-shimmer">{{ Auth::user()->parentAdvisor->name }}</span>
                        @else
                            ¡Hola de nuevo, <span class="text-shimmer">{{ Auth::user()->name }}</span>!
                        @endif
                    </h2>
                    <p class="mt-5 text-base md:text-lg text-white/60 max-w-xl leading-relaxed">
                        Hoy es un excelente día para avanzar en la frontera del conocimiento científico.
                    </p>
                </div>
                <div class="relative hidden lg:block flex-shrink-0" aria-hidden="true">
                    <div class="w-44 h-44 bg-gradient-to-tr from-uni-gold-500 to-uni-gold-300 rounded-[2.5rem] rotate-12 shadow-2xl shadow-uni-gold-500/20 flex items-center justify-center animate-float-y">
                        <svg class="w-20 h-20 text-uni-navy-950 -rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.989-2.386l-.548-.547z" />
                        </svg>
                    </div>
                </div>
            </div>
        </section>

        <div class="animate-fade-in-up delay-100">
            <x-section-title subtitle="Acceso rápido a tus herramientas de investigación">Navegación Principal</x-section-title>

            <!-- Quick Access Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <x-stats-card
                    label="{{ Auth::user()->is_admin ? 'Gestión' : 'Artículos' }}"
                    value="{{ Auth::user()->is_admin ? 'Administrar' : 'Mis Trabajos' }}"
                    color="navy"
                    :href="Auth::user()->is_admin ? route('admin.articles') : route('articles.index')"
                    class="animate-fade-in-up delay-200">
                    <x-slot name="icon">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </x-slot>
                </x-stats-card>

                <x-stats-card
                    label="Concursos"
                    value="Eventos"
                    color="gold"
                    :href="route('events.index')"
                    class="animate-fade-in-up delay-300">
                    <x-slot name="icon">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </x-slot>
                </x-stats-card>

                <x-stats-card
                    label="Recursos"
                    value="Librería"
                    color="navy"
                    :href="route('library.index')"
                    class="animate-fade-in-up delay-400">
                    <x-slot name="icon">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </x-slot>
                </x-stats-card>

                <x-stats-card
                    label="Comunidad"
                    value="Perfiles"
                    color="gold"
                    :href="route('profile.edit')"
                    class="animate-fade-in-up delay-500">
                    <x-slot name="icon">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </x-slot>
                </x-stats-card>
            </div>
        </div>

    </div>
</x-app-layout>
