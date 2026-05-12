<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UTP Académico | Portal de Investigación</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-white text-gray-900 selection:bg-purple-900 selection:text-white">

    <!-- ─── Navbar ──────────────────────────────────────────────── -->
    <nav class="bg-purple-950 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex justify-between items-center h-16">

                <a href="/" class="flex items-center gap-3">
                    <img src="{{ asset('images/utp-logo.png') }}" alt="UTP Logo"
                         class="h-9 w-auto">
                    <span class="text-white/80 text-sm font-medium hidden sm:block tracking-wide">
                        Portal de Investigación
                    </span>
                </a>

                <div class="flex items-center gap-3">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}"
                               class="px-4 py-2 bg-white text-purple-950 rounded-lg text-sm font-semibold hover:bg-purple-50 transition-colors">
                                Panel Principal
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                               class="text-sm text-white/70 hover:text-white transition-colors font-medium">
                                Iniciar Sesión
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                   class="px-4 py-2 bg-white text-purple-950 rounded-lg text-sm font-semibold hover:bg-purple-50 transition-colors">
                                    Crear Cuenta
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>

            </div>
        </div>
    </nav>

    <!-- ─── Hero ─────────────────────────────────────────────────── -->
    <section class="relative bg-purple-950 overflow-hidden">
        <!-- Campus image -->
        <div class="absolute inset-0">
            <img src="{{ asset('images/utp-campus-v2.jpg') }}"
                 class="w-full h-full object-cover opacity-50" alt="Campus UTP">
            <div class="absolute inset-0 bg-gradient-to-r from-purple-950/90 via-purple-950/60 to-purple-950/30"></div>
            <div class="absolute inset-0 bg-gradient-to-b from-transparent to-purple-950/80"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-6 py-28 lg:py-44 flex flex-col items-center text-center">
            <div class="glass-card-dark p-8 md:p-16 rounded-[3rem] max-w-4xl border-white/20">
                <p class="text-cyber-purple-300 text-xs font-bold tracking-widest uppercase mb-5 animate-pulse">
                    Universidad Tecnológica del Panamá - UTP
                </p>
                <h1 class="text-4xl lg:text-7xl font-black text-white leading-[1.05] mb-8 tracking-tighter">
                    Gestión de <span class="tech-gradient-text italic">Investigaciones</span> Académicas
                </h1>
                <p class="text-lg text-white/60 leading-relaxed mb-12 max-w-2xl mx-auto font-medium">
                    Plataforma institucional de vanguardia para la presentación, revisión y publicación de artículos y trabajos de investigación científica de alto impacto.
                </p>
                <div class="flex flex-wrap justify-center gap-6">
                    <x-button-modern onclick="window.location.href='#investigaciones'">
                        Explorar Investigaciones
                    </x-button-modern>
                    @guest
                        <x-button-modern variant="secondary" onclick="window.location.href='{{ route('register') }}'">
                            Unirse a la Comunidad
                        </x-button-modern>
                    @endguest
                </div>
            </div>
        </div>

        <!-- Bottom fade into white -->
        <div class="absolute bottom-0 left-0 right-0 h-20 bg-gradient-to-t from-white to-transparent"></div>
    </section>

    <!-- ─── Stats ─────────────────────────────────────────────────── -->
    <section class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-6 py-14">
            <dl class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div>
                    <dt class="text-3xl font-bold text-purple-900">{{ $publishedArticles->count() }}</dt>
                    <dd class="text-sm text-gray-500 mt-1">Artículos publicados</dd>
                </div>
                <div>
                    <dt class="text-3xl font-bold text-purple-900">{{ $events->count() }}</dt>
                    <dd class="text-sm text-gray-500 mt-1">Eventos científicos</dd>
                </div>
                <div>
                    <dt class="text-3xl font-bold text-purple-900">100%</dt>
                    <dd class="text-sm text-gray-500 mt-1">Revisado por asesores</dd>
                </div>
                <div>
                    <dt class="text-3xl font-bold text-purple-900">Abierto</dt>
                    <dd class="text-sm text-gray-500 mt-1">Acceso institucional</dd>
                </div>
            </dl>
        </div>
    </section>

    <!-- ─── Investigaciones recientes ────────────────────────────── -->
    <section id="investigaciones" class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6">

            <div class="mb-14">
                <h2 class="text-2xl font-bold text-gray-900" style="font-family: 'Playfair Display', serif;">
                    Investigaciones recientes
                </h2>
                <p class="mt-2 text-gray-500 text-sm max-w-xl">
                    Trabajos de grado e investigaciones aprobadas por la academia de la Universidad Tecnológica del Perú.
                </p>
            </div>

            @if($publishedArticles->count() > 0)
                <div x-data="{
                        activeSlide: 0,
                        totalSlides: {{ $publishedArticles->count() }},
                        next() { this.activeSlide = (this.activeSlide + 1) % this.totalSlides; },
                        prev() { this.activeSlide = (this.activeSlide - 1 + this.totalSlides) % this.totalSlides; },
                        init() {
                            if (this.totalSlides > 1) {
                                setInterval(() => { this.next() }, 7000);
                            }
                        }
                    }"
                    class="relative max-w-4xl">

                    <!-- Slide container -->
                    <div class="overflow-hidden rounded-2xl bg-white border border-gray-200 shadow-sm">
                        <div class="flex transition-transform duration-500 ease-in-out"
                             :style="'transform: translateX(-' + (activeSlide * 100) + '%)'">

                            @foreach($publishedArticles as $article)
                                <div class="w-full flex-shrink-0">
                                    <div class="grid grid-cols-1 md:grid-cols-5">

                                        <!-- Text side -->
                                        <div class="md:col-span-3 p-10 lg:p-14 flex flex-col justify-center">
                                            <div class="flex items-center gap-2 mb-5">
                                                <span class="bg-purple-100 text-purple-800 text-[11px] font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                                                    {{ $article->career ?? 'Investigación' }}
                                                </span>
                                                <span class="text-sm text-gray-400">{{ $article->year ?? date('Y') }}</span>
                                            </div>

                                            <h3 class="text-xl lg:text-2xl font-bold text-gray-900 leading-snug mb-6"
                                                style="font-family: 'Playfair Display', serif;">
                                                {{ $article->title }}
                                            </h3>

                                            <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl border border-gray-100">
                                                <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center text-purple-800 font-bold flex-shrink-0">
                                                    {{ substr($article->student->name ?? 'E', 0, 1) }}
                                                </div>
                                                <div>
                                                    <p class="text-xs text-gray-400 mb-0.5">Autor/es</p>
                                                    <p class="text-sm font-semibold text-gray-900">{{ $article->student->name ?? 'Estudiante no registrado' }}</p>
                                                    @if($article->students && $article->students != ($article->student->name ?? ''))
                                                        <p class="text-xs text-gray-400 mt-0.5">Y otros colaboradores</p>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="mt-7">
                                                <a href="{{ route('profile.public.show', $article->student->id ?? 1) }}"
                                                   class="inline-flex items-center gap-2 text-sm font-semibold text-purple-700 hover:text-purple-900 transition-colors group">
                                                    Ver perfil del autor
                                                    <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>

                                        <!-- Accent side -->
                                        <div class="hidden md:flex md:col-span-2 bg-purple-950 items-center justify-center p-10 relative overflow-hidden">
                                            <!-- Subtle grid pattern -->
                                            <div class="absolute inset-0 opacity-[0.07]"
                                                 style="background-image: linear-gradient(rgba(255,255,255,.5) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.5) 1px, transparent 1px); background-size: 24px 24px;">
                                            </div>
                                            <!-- Document icon -->
                                            <div class="relative z-10 flex flex-col items-center gap-4 text-center">
                                                <div class="w-20 h-20 rounded-2xl bg-white/10 border border-white/20 flex items-center justify-center">
                                                    <svg class="w-10 h-10 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                    </svg>
                                                </div>
                                                <p class="text-white/40 text-xs font-medium tracking-widest uppercase">Investigación</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>

                    <!-- Navigation arrows -->
                    @if($publishedArticles->count() > 1)
                        <button @click="prev()"
                                class="absolute -left-5 top-1/2 -translate-y-1/2 w-10 h-10 bg-white rounded-full shadow-md border border-gray-200 flex items-center justify-center text-gray-600 hover:text-purple-900 hover:border-purple-200 transition-colors z-10">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </button>
                        <button @click="next()"
                                class="absolute -right-5 top-1/2 -translate-y-1/2 w-10 h-10 bg-white rounded-full shadow-md border border-gray-200 flex items-center justify-center text-gray-600 hover:text-purple-900 hover:border-purple-200 transition-colors z-10">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>

                        <!-- Dots -->
                        <div class="flex justify-center mt-6 gap-2">
                            <template x-for="(slide, index) in totalSlides" :key="index">
                                <button @click="activeSlide = index"
                                        :class="activeSlide === index ? 'w-6 bg-purple-900' : 'w-2 bg-gray-300'"
                                        class="h-2 rounded-full transition-all duration-300">
                                </button>
                            </template>
                        </div>
                    @endif

                </div>
            @else
                <div class="max-w-4xl bg-white rounded-2xl border border-dashed border-gray-200 p-16 text-center">
                    <svg class="w-12 h-12 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <h3 class="text-base font-semibold text-gray-700 mb-1">Sin investigaciones publicadas aún</h3>
                    <p class="text-sm text-gray-400">Las investigaciones aprobadas aparecerán aquí.</p>
                </div>
            @endif

        </div>
    </section>

    <!-- ─── Actualidad y Eventos ──────────────────────────────────── -->
    <section class="py-24 bg-white border-t border-gray-100"
             x-data="{
                showModal: false,
                activeItem: null,
                openModal(item) {
                    this.activeItem = item;
                    this.showModal = true;
                    document.body.style.overflow = 'hidden';
                },
                closeModal() {
                    this.showModal = false;
                    document.body.style.overflow = 'auto';
                }
             }">
        <div class="max-w-7xl mx-auto px-6">

            <div class="flex justify-between items-end mb-14">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900" style="font-family: 'Playfair Display', serif;">
                        Actualidad y Eventos
                    </h2>
                    <p class="mt-2 text-gray-500 text-sm">
                        Noticias, avisos y convocatorias de la comunidad investigadora.
                    </p>
                </div>
                <a href="{{ route('events.index') }}"
                   class="hidden md:inline-flex items-center gap-1.5 text-sm font-semibold text-purple-700 hover:text-purple-900 transition-colors">
                    Ver todos los eventos
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @php
                    $feed = collect();

                    foreach($notices as $notice) {
                        $feed->push((object)[
                            'id'       => $notice->id,
                            'title'    => $notice->title,
                            'summary'  => $notice->summary,
                            'content'  => $notice->content,
                            'image'    => $notice->image_path
                                            ? Storage::url($notice->image_path)
                                            : 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?q=80&w=800&auto=format&fit=crop',
                            'category' => $notice->category,
                            'date'     => $notice->created_at->locale('es')->isoFormat('D [de] MMMM, YYYY'),
                            'raw_date' => $notice->created_at,
                            'is_event' => false,
                        ]);
                    }

                    foreach($events as $event) {
                        $feed->push((object)[
                            'id'       => $event->id,
                            'title'    => $event->name,
                            'summary'  => $event->description,
                            'content'  => $event->description,
                            'image'    => $event->image_path
                                            ? Storage::url($event->image_path)
                                            : 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?q=80&w=800&auto=format&fit=crop',
                            'category' => 'Evento',
                            'date'     => $event->created_at->locale('es')->isoFormat('D [de] MMMM, YYYY'),
                            'raw_date' => $event->created_at,
                            'is_event' => true,
                        ]);
                    }

                    $feed = $feed->sortByDesc('raw_date')->take(6);
                @endphp

                @forelse($feed as $item)
                    <article class="group cursor-pointer" @click="openModal({{ json_encode($item) }})">
                        <!-- Thumbnail -->
                        <div class="aspect-video rounded-xl overflow-hidden bg-gray-100 mb-4 relative">
                            <img src="{{ $item->image }}"
                                 class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-500"
                                 alt="{{ $item->title }}" loading="lazy">
                            @php
                                $badge = match(true) {
                                    $item->is_event => 'bg-purple-900',
                                    $item->category === 'Aviso' => 'bg-blue-700',
                                    $item->category === 'Investigación' => 'bg-purple-700',
                                    default => 'bg-gray-700',
                                };
                            @endphp
                            <span class="absolute top-3 left-3 {{ $badge }} text-white text-[10px] font-bold uppercase tracking-widest px-2.5 py-1 rounded-md">
                                {{ $item->category }}
                            </span>
                        </div>

                        <!-- Text -->
                        <p class="text-xs text-gray-400 font-medium mb-1.5">{{ $item->date }}</p>
                        <h3 class="text-base font-bold text-gray-900 leading-snug group-hover:text-purple-800 transition-colors line-clamp-2">
                            {{ $item->title }}
                        </h3>
                        @if($item->summary)
                            <p class="text-sm text-gray-500 mt-1.5 line-clamp-2 leading-relaxed">
                                {{ $item->summary }}
                            </p>
                        @endif
                    </article>
                @empty
                    <div class="col-span-3 text-center py-16 border border-dashed border-gray-200 rounded-2xl">
                        <svg class="w-10 h-10 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                        <p class="text-sm text-gray-400 font-medium">No hay actualizaciones publicadas aún.</p>
                    </div>
                @endforelse
            </div>

        </div>

        <!-- ─── Modal ───────────────────────────────────────────── -->
        <template x-if="showModal">
            <div class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100">

                <!-- Backdrop -->
                <div class="absolute inset-0 bg-gray-900/70 backdrop-blur-sm" @click="closeModal()"></div>

                <!-- Panel -->
                <div class="bg-white w-full max-w-3xl max-h-[90vh] rounded-2xl shadow-2xl relative z-10 overflow-hidden flex flex-col"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100">

                    <!-- Close button -->
                    <button @click="closeModal()"
                            class="absolute top-4 right-4 z-20 w-9 h-9 bg-black/20 hover:bg-black/30 backdrop-blur-sm rounded-full flex items-center justify-center text-white transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>

                    <div class="overflow-y-auto flex-grow">
                        <!-- Image header -->
                        <div class="w-full h-56 sm:h-72 relative flex-shrink-0">
                            <img :src="activeItem.image" class="w-full h-full object-cover" :alt="activeItem.title">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        </div>

                        <!-- Content -->
                        <div class="p-8 sm:p-10">
                            <p class="text-xs text-purple-700 font-bold uppercase tracking-widest mb-2"
                               x-text="activeItem.category + ' · ' + activeItem.date"></p>
                            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 leading-snug mb-6"
                                x-text="activeItem.title"
                                style="font-family: 'Playfair Display', serif;"></h2>

                            <div class="text-gray-600 text-base leading-relaxed whitespace-pre-line"
                                 x-text="activeItem.content || activeItem.summary"></div>

                            <template x-if="activeItem.is_event">
                                <div class="mt-10 pt-6 border-t border-gray-100">
                                    <a href="{{ route('events.index') }}"
                                       class="inline-flex items-center gap-2 px-5 py-2.5 bg-purple-900 text-white rounded-lg text-sm font-semibold hover:bg-purple-800 transition-colors">
                                        Ver todos los eventos
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </a>
                                </div>
                            </template>
                        </div>
                    </div>

                </div>
            </div>
        </template>

    </section>

    <!-- ─── Footer ──────────────────────────────────────────────── -->
    <footer class="bg-gray-950 text-white">
        <div class="max-w-7xl mx-auto px-6 py-16">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10">

                <div class="md:col-span-2">
                    <p class="text-white font-bold text-lg mb-3">UTP <span class="text-purple-400">Académico</span></p>
                    <p class="text-gray-400 text-sm leading-relaxed max-w-xs">
                        Plataforma oficial para la gestión, revisión y publicación de trabajos de grado de la Universidad Tecnológica del Perú.
                    </p>
                </div>

                <div>
                    <h4 class="text-sm font-semibold text-gray-300 mb-4">Accesos</h4>
                    <ul class="space-y-2 text-sm text-gray-500">
                        <li><a href="#" class="hover:text-white transition-colors">Portal UTP</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Biblioteca Institucional</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Formatos de Tesis</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-sm font-semibold text-gray-300 mb-4">Soporte</h4>
                    <ul class="space-y-2 text-sm text-gray-500">
                        <li><a href="#" class="hover:text-white transition-colors">Mesa de Ayuda</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Preguntas Frecuentes</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Contacto</a></li>
                    </ul>
                </div>

            </div>

            <div class="mt-12 pt-8 border-t border-gray-800 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2 text-xs text-gray-600">
                <p>&copy; {{ date('Y') }} Universidad Tecnológica del Perú. Todos los derechos reservados.</p>
                <p>Vía Simón Bolívar (Transístmica) — Campus Víctor Levi Sasso</p>
            </div>
        </div>
    </footer>

</body>
</html>
