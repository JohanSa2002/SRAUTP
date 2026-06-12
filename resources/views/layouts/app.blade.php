<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'UTP Académico') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-uni-cream-50 text-gray-900">

    <!-- Skip link for keyboard / screen reader users -->
    <a href="#main-content"
       class="sr-only focus:not-sr-only focus:fixed focus:top-3 focus:left-3 focus:z-[100] focus:px-4 focus:py-2.5
              focus:bg-uni-navy-900 focus:text-white focus:rounded-xl focus:shadow-lg text-sm font-semibold">
        Saltar al contenido principal
    </a>

    <!-- Subtle academic background pattern -->
    <div class="fixed inset-0 pointer-events-none z-0 uni-bg-grid opacity-60" aria-hidden="true"></div>

    <div class="relative z-10 flex flex-col min-h-dvh">

        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white/80 backdrop-blur-md border-b border-gray-100 shadow-sm sticky top-[66px] z-40">
                <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8 flex items-center gap-4">
                    <!-- Gold accent bar -->
                    <div class="w-1 h-6 bg-uni-gold-400 rounded-full flex-shrink-0"></div>
                    <div class="text-base font-semibold text-uni-navy-800 tracking-wide font-serif">
                        {{ $header }}
                    </div>
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main id="main-content" tabindex="-1" class="flex-grow focus:outline-none">
            <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-uni-navy-900 border-t border-uni-gold-500/10 py-5 mt-auto">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col sm:flex-row justify-between items-center gap-2">
                    <p class="text-white/30 text-xs">
                        &copy; {{ date('Y') }} UTP — Sistema de Evaluación y Registro Académico
                    </p>
                    <div class="flex items-center gap-1.5">
                        <div class="w-1.5 h-1.5 bg-uni-gold-500/60 rounded-full"></div>
                        <p class="text-white/20 text-xs">Diseñado para la excelencia científica</p>
                    </div>
                </div>
            </div>
        </footer>

    </div>
</body>
</html>
