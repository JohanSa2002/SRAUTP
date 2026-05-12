<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>UTP | Acceso Académico</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased cyber-gradient-bg">
    <div class="min-h-screen relative flex flex-col sm:justify-center items-center pt-6 sm:pt-0 overflow-hidden">

        <!-- Animated Background Blobs -->
        <div class="absolute inset-0 z-0 pointer-events-none opacity-50">
            <div
                class="absolute top-[20%] left-[20%] w-96 h-96 bg-cyber-purple-400 rounded-full mix-blend-multiply filter blur-3xl animate-blob">
            </div>
            <div
                class="absolute bottom-[20%] right-[20%] w-80 h-80 bg-blue-300 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-2000">
            </div>
        </div>

        <div class="relative z-10 w-full flex flex-col items-center px-4">
            <div class="mb-8 animate-in fade-in zoom-in duration-700">
                <a href="/" class="flex items-center space-x-2">
                    <div class="bg-cyber-purple-500 p-3 rounded-2xl shadow-xl shadow-cyber-purple-500/20">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                        </svg>
                    </div>
                </a>
            </div>

            <div
                class="w-full sm:max-w-md bg-white/60 backdrop-blur-2xl shadow-2xl overflow-hidden sm:rounded-[2.5rem] border border-white/40 p-10 animate-in slide-in-from-bottom-8 duration-700">
                <div class="mb-8 text-center">
                    <h2 class="text-2xl font-black text-gray-900 tracking-tight">UTP<span
                            class="text-cyber-purple-500">_ACADÉMICO</span></h2>
                    <p class="text-xs text-gray-400 uppercase font-black tracking-widest mt-1">Terminal de Acceso</p>
                </div>

                {{ $slot }}
            </div>

            <div class="mt-8 text-center animate-in fade-in duration-1000 delay-500">
                <p class="text-xs text-gray-400 font-medium">&copy; {{ date('Y') }} UTP · Sistema Académico de
                    Vanguardia</p>
            </div>
        </div>
    </div>
</body>

</html>