<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>UTP | Acceso Académico</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">

    <!-- Dark navy background with academic pattern -->
    <div class="fixed inset-0 hero-academic z-0">
        <div class="absolute inset-0 hero-academic-pattern"></div>
        <!-- Decorative rings -->
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2
                    w-[700px] h-[700px] border border-uni-gold-500/6 rounded-full animate-spin-very-slow pointer-events-none"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2
                    w-[450px] h-[450px] border border-uni-gold-500/8 rounded-full pointer-events-none"></div>
        <!-- Floating dots -->
        <div class="absolute top-[15%] left-[10%] w-1.5 h-1.5 bg-uni-gold-400/30 rounded-full animate-float-y delay-100"></div>
        <div class="absolute top-[70%] right-[12%] w-1 h-1 bg-uni-gold-300/25 rounded-full animate-float-y delay-400"></div>
        <div class="absolute bottom-[20%] left-[20%] w-2 h-2 bg-white/10 rounded-full animate-float-y delay-600"></div>
    </div>

    <div class="relative z-10 min-h-dvh flex flex-col items-center justify-center py-12 px-4">

        <!-- Logo / brand -->
        <div class="mb-8 text-center animate-fade-in delay-100">
            <a href="/" class="inline-flex items-center gap-3 group mb-5 block">
                <div class="w-12 h-12 bg-uni-gold-400 rounded-xl flex items-center justify-center
                            shadow-xl shadow-uni-gold-400/20 mx-auto
                            group-hover:bg-uni-gold-300 transition-colors duration-200">
                    <svg class="w-6 h-6 text-uni-navy-950" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                    </svg>
                </div>
            </a>
            <div class="mt-3">
                <span class="font-serif text-2xl font-bold text-white">UTP</span>
                <span class="font-serif text-2xl font-bold text-uni-gold-400"> Académico</span>
            </div>
            <p class="academic-label text-white/30 mt-1">Sistema de Investigación Institucional</p>
        </div>

        <!-- Card -->
        <div class="w-full sm:max-w-md animate-fade-in-up delay-200">
            <!-- Gold top bar -->
            <div class="h-1 bg-gradient-to-r from-uni-gold-400 via-uni-gold-300 to-uni-gold-500 rounded-t-2xl"></div>

            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-b-2xl shadow-2xl p-8 sm:p-10">

                <!-- Section label -->
                <div class="text-center mb-8">
                    <div class="w-10 h-10 bg-white/5 border border-white/10 rounded-xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-5 h-5 text-uni-gold-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                        </svg>
                    </div>
                    <h2 class="font-serif text-xl font-bold text-white">Acceso Académico</h2>
                    <p class="text-white/40 text-xs mt-1">Ingresa con tus credenciales institucionales</p>
                </div>

                <div class="[&_label]:text-white/70 [&_label]:text-sm
                            [&_input]:bg-white/5 [&_input]:border-white/15 [&_input]:text-white
                            [&_input:focus]:border-uni-gold-400/60 [&_input:focus]:ring-uni-gold-400/20
                            [&_input]:placeholder:text-white/25
                            [&_a]:text-uni-gold-400 [&_a:hover]:text-uni-gold-300">
                    {{ $slot }}
                </div>
            </div>
        </div>

        <!-- Footer note -->
        <p class="mt-8 text-white/20 text-xs text-center animate-fade-in delay-600">
            &copy; {{ date('Y') }} Universidad Tecnológica del Perú
        </p>
    </div>
</body>
</html>
