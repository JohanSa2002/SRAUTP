<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UTP Académico | Portal de Investigación</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-white text-gray-900 selection:bg-uni-gold-200 selection:text-uni-navy-950">

<!-- ═══════════════════════════════════════════════════
     ANNOUNCEMENT BAR
════════════════════════════════════════════════════ -->
<div class="bg-uni-navy-950 border-b border-uni-gold-500/20 py-2 px-4 text-center">
    <p class="academic-label text-uni-gold-400/80 text-[10px]">
        Universidad Tecnológica del Perú — Sistema Institucional de Investigación Académica
    </p>
</div>

<!-- ═══════════════════════════════════════════════════
     NAVIGATION
════════════════════════════════════════════════════ -->
<nav x-data="navScroll()"
     :class="scrolled ? 'shadow-xl shadow-uni-navy-950/40' : ''"
     class="bg-uni-navy-900 sticky top-0 z-50 border-b border-uni-gold-500/10 transition-shadow duration-300">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex justify-between items-center h-16">

            <a href="/" class="flex items-center gap-3 group">
                <div class="relative">
                    <div class="w-9 h-9 bg-uni-gold-400 rounded-lg flex items-center justify-center shadow-lg shadow-uni-gold-400/20 group-hover:bg-uni-gold-300 transition-colors duration-200">
                        <svg class="w-5 h-5 text-uni-navy-950" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/>
                        </svg>
                    </div>
                    <!-- Glow ring -->
                    <div class="absolute inset-0 rounded-lg bg-uni-gold-400/20 animate-pulse-ring pointer-events-none"></div>
                </div>
                <div class="hidden sm:block">
                    <span class="font-serif text-lg font-bold text-white leading-none">UTP</span>
                    <span class="text-uni-gold-400 font-serif text-lg font-bold"> Académico</span>
                </div>
            </a>

            <div class="flex items-center gap-3">
                @if(Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}"
                           class="btn-uni-primary text-xs py-2.5 px-5">
                            Panel Principal
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="nav-link-uni text-sm hidden sm:block">
                            Iniciar Sesión
                        </a>
                        @if(Route::has('register'))
                            <a href="{{ route('register') }}"
                               class="btn-uni-primary text-xs py-2.5 px-5">
                                Crear Cuenta
                            </a>
                        @endif
                    @endauth
                @endif
            </div>

        </div>
    </div>

    <!-- Gold bottom line accent -->
    <div class="h-px bg-gradient-to-r from-transparent via-uni-gold-500/30 to-transparent"></div>
</nav>


<!-- ═══════════════════════════════════════════════════
     HERO SECTION
════════════════════════════════════════════════════ -->
<section class="relative min-h-[92vh] flex items-center justify-center overflow-hidden hero-academic">

    <!-- Campus background image -->
    <div class="absolute inset-0" x-data="parallax(0.2)">
        <img src="{{ asset('images/utp-campus-v2.jpg') }}"
             class="w-full h-full object-cover opacity-25 scale-110"
             :style="'transform: translateY(' + offset + 'px) scale(1.1)'"
             alt="Campus UTP">
        <div class="absolute inset-0 bg-gradient-to-b from-uni-navy-950/80 via-uni-navy-900/70 to-uni-navy-950/95"></div>
    </div>

    <!-- Academic grid overlay -->
    <div class="absolute inset-0 hero-academic-pattern opacity-60 pointer-events-none"></div>

    <!-- Decorative concentric rings -->
    <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
        <div class="w-[700px] h-[700px] rounded-full border border-uni-gold-500/6 animate-spin-very-slow"></div>
    </div>
    <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
        <div class="w-[500px] h-[500px] rounded-full border border-uni-gold-500/8"></div>
    </div>
    <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
        <div class="w-[320px] h-[320px] rounded-full border border-uni-gold-500/10 animate-pulse-ring"></div>
    </div>

    <!-- Floating gold particles -->
    <div class="absolute inset-0 pointer-events-none overflow-hidden">
        <div class="absolute top-[15%] left-[10%] w-1.5 h-1.5 bg-uni-gold-400/50 rounded-full animate-float-y delay-100"></div>
        <div class="absolute top-[25%] right-[12%] w-1 h-1 bg-uni-gold-300/40 rounded-full animate-float-y delay-500"></div>
        <div class="absolute top-[60%] left-[8%] w-2 h-2 bg-uni-gold-500/30 rounded-full animate-float-y delay-300"></div>
        <div class="absolute bottom-[20%] right-[15%] w-1 h-1 bg-uni-gold-400/40 rounded-full animate-float-y delay-700"></div>
        <div class="absolute top-[40%] right-[5%] w-1.5 h-1.5 bg-white/20 rounded-full animate-float-y delay-200"></div>
    </div>

    <!-- Hero Content -->
    <div class="relative z-10 text-center max-w-5xl mx-auto px-6 py-20">

        <!-- Institution badge -->
        <div class="animate-fade-in delay-100 mb-6 inline-flex items-center gap-3">
            <div class="gold-rule-short"></div>
            <span class="academic-label text-uni-gold-400/90">
                Universidad Tecnológica del Perú
            </span>
            <div class="gold-rule-short"></div>
        </div>

        <!-- Main heading -->
        <h1 class="academic-heading text-5xl sm:text-6xl lg:text-8xl font-bold text-white mb-8
                   animate-fade-in-up delay-200">
            Portal de
            <em class="block text-shimmer not-italic">Investigación</em>
            Científica
        </h1>

        <!-- Separator line -->
        <div class="animate-fade-in delay-400 mb-8 flex justify-center">
            <div class="h-px w-32 bg-gradient-to-r from-transparent via-uni-gold-400/60 to-transparent"></div>
        </div>

        <!-- Description -->
        <p class="text-white/55 text-lg leading-relaxed max-w-2xl mx-auto mb-12 font-medium
                  animate-fade-in-up delay-500">
            Plataforma institucional para la presentación, revisión y publicación de artículos
            y trabajos de investigación de alto impacto académico.
        </p>

        <!-- CTA Buttons -->
        <div class="flex flex-wrap justify-center gap-4 animate-fade-in-up delay-700">
            <a href="#investigaciones" class="btn-uni-primary group text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                Explorar Investigaciones
            </a>
            @guest
                <a href="{{ route('register') }}" class="btn-uni-secondary text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                    Unirse a la Comunidad
                </a>
            @endguest
        </div>

        <!-- Typing tag line (optional animated) -->
        <div class="mt-10 animate-fade-in delay-1000">
            <span class="academic-label text-white/25">
                investigación · asesoría · publicación · excelencia
            </span>
        </div>
    </div>

    <!-- Scroll mouse indicator -->
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce animate-fade-in delay-1200">
        <div class="w-6 h-10 border-2 border-uni-gold-400/40 rounded-full flex items-start justify-center pt-1.5">
            <div class="w-1 h-2.5 bg-uni-gold-400 rounded-full animate-float-y"></div>
        </div>
    </div>

</section>


<!-- ═══════════════════════════════════════════════════
     STATS BAND
════════════════════════════════════════════════════ -->
<section class="bg-uni-navy-950 border-y border-uni-gold-500/15">
    <div class="max-w-7xl mx-auto px-6 py-16">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 md:gap-12">

            <div class="text-center" data-reveal data-countup x-data="countUp({{ $publishedArticles->count() }})">
                <div class="stat-num" x-text="current">0</div>
                <div class="stat-label">Artículos publicados</div>
            </div>

            <div class="text-center" data-reveal="d1" data-countup x-data="countUp({{ $events->count() }})">
                <div class="stat-num" x-text="current">0</div>
                <div class="stat-label">Eventos científicos</div>
            </div>

            <div class="text-center" data-reveal="d2">
                <div class="stat-num">100<span class="text-3xl">%</span></div>
                <div class="stat-label">Revisado por asesores</div>
            </div>

            <div class="text-center" data-reveal="d3">
                <div class="font-serif text-5xl font-bold text-uni-gold-400">∞</div>
                <div class="stat-label">Acceso institucional</div>
            </div>

        </div>
    </div>

    <!-- Bottom gold rule -->
    <div class="gold-rule opacity-40"></div>
</section>


<!-- ═══════════════════════════════════════════════════
     PILLARS / FEATURES STRIP
════════════════════════════════════════════════════ -->
<section class="bg-white py-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-px bg-gray-100 rounded-2xl overflow-hidden shadow-sm">

            <!-- Pillar 1 -->
            <div class="bg-white p-10 group hover:bg-uni-cream-50 transition-colors duration-300" data-reveal>
                <div class="w-12 h-12 rounded-xl bg-uni-navy-50 flex items-center justify-center mb-6
                             group-hover:bg-uni-gold-100 transition-colors duration-300">
                    <svg class="w-6 h-6 text-uni-navy-600 group-hover:text-uni-gold-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h3 class="font-serif font-bold text-xl text-uni-navy-900 mb-3">Publicación</h3>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Sube tus trabajos de investigación y artículos científicos de forma estructurada, con metadatos completos y trazabilidad.
                </p>
                <div class="mt-6 h-0.5 w-0 bg-uni-gold-400 group-hover:w-12 transition-all duration-500 rounded-full"></div>
            </div>

            <!-- Pillar 2 -->
            <div class="bg-white p-10 group hover:bg-uni-cream-50 transition-colors duration-300" data-reveal="d2">
                <div class="w-12 h-12 rounded-xl bg-uni-navy-50 flex items-center justify-center mb-6
                             group-hover:bg-uni-gold-100 transition-colors duration-300">
                    <svg class="w-6 h-6 text-uni-navy-600 group-hover:text-uni-gold-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                    </svg>
                </div>
                <h3 class="font-serif font-bold text-xl text-uni-navy-900 mb-3">Evaluación</h3>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Proceso riguroso de revisión por asesores calificados que garantiza la calidad académica de cada investigación.
                </p>
                <div class="mt-6 h-0.5 w-0 bg-uni-gold-400 group-hover:w-12 transition-all duration-500 rounded-full"></div>
            </div>

            <!-- Pillar 3 -->
            <div class="bg-white p-10 group hover:bg-uni-cream-50 transition-colors duration-300" data-reveal="d4">
                <div class="w-12 h-12 rounded-xl bg-uni-navy-50 flex items-center justify-center mb-6
                             group-hover:bg-uni-gold-100 transition-colors duration-300">
                    <svg class="w-6 h-6 text-uni-navy-600 group-hover:text-uni-gold-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="font-serif font-bold text-xl text-uni-navy-900 mb-3">Difusión</h3>
                <p class="text-gray-500 text-sm leading-relaxed">
                    Proyecta tu trabajo a la comunidad académica a través del repositorio institucional y los eventos científicos de la universidad.
                </p>
                <div class="mt-6 h-0.5 w-0 bg-uni-gold-400 group-hover:w-12 transition-all duration-500 rounded-full"></div>
            </div>

        </div>
    </div>
</section>


<!-- ═══════════════════════════════════════════════════
     INVESTIGACIONES RECIENTES
════════════════════════════════════════════════════ -->
<section id="investigaciones" class="py-28 bg-uni-cream-100">
    <div class="max-w-7xl mx-auto px-6">

        <!-- Section header -->
        <div class="mb-16" data-reveal>
            <span class="academic-label text-uni-gold-600 block mb-3">Repositorio Institucional</span>
            <h2 class="font-serif text-4xl font-bold text-uni-navy-900 mb-4">
                Investigaciones Recientes
            </h2>
            <div class="flex items-center gap-4">
                <div class="gold-rule-short"></div>
                <p class="text-gray-500 text-sm leading-relaxed max-w-xl">
                    Trabajos de grado e investigaciones aprobadas por el cuerpo académico de la Universidad Tecnológica del Perú.
                </p>
            </div>
        </div>

        @if($publishedArticles->count() > 0)
            <div data-reveal="d1"
                 x-data="{
                     activeSlide: 0,
                     totalSlides: {{ $publishedArticles->count() }},
                     next() { this.activeSlide = (this.activeSlide + 1) % this.totalSlides; },
                     prev() { this.activeSlide = (this.activeSlide - 1 + this.totalSlides) % this.totalSlides; },
                     init() {
                         if (this.totalSlides > 1) {
                             setInterval(() => { this.next(); }, 7000);
                         }
                     }
                 }"
                 class="relative max-w-4xl">

                <!-- Slide container -->
                <div class="overflow-hidden rounded-2xl bg-white border border-gray-100 shadow-lg shadow-uni-navy-900/5">
                    <div class="flex transition-transform duration-500 ease-[cubic-bezier(0.16,1,0.3,1)]"
                         :style="'transform: translateX(-' + (activeSlide * 100) + '%)'">

                        @foreach($publishedArticles as $article)
                            <div class="w-full flex-shrink-0">
                                <div class="grid grid-cols-1 md:grid-cols-5">

                                    <!-- Text side -->
                                    <div class="md:col-span-3 p-10 lg:p-14 flex flex-col justify-center">
                                        <div class="flex items-center gap-3 mb-6">
                                            <span class="badge-academic">
                                                {{ $article->career ?? 'Investigación' }}
                                            </span>
                                            <span class="text-xs text-gray-400 font-medium">
                                                {{ $article->year ?? date('Y') }}
                                            </span>
                                        </div>

                                        <h3 class="font-serif text-2xl lg:text-3xl font-bold text-uni-navy-900 leading-tight mb-6">
                                            {{ $article->title }}
                                        </h3>

                                        <div class="flex items-center gap-4 p-4 bg-uni-cream-100 rounded-xl border border-uni-cream-200">
                                            <div class="w-10 h-10 rounded-full bg-uni-navy-100 flex items-center justify-center
                                                        text-uni-navy-700 font-bold flex-shrink-0 font-serif">
                                                {{ substr($article->student->name ?? 'E', 0, 1) }}
                                            </div>
                                            <div>
                                                <p class="text-xs text-gray-400 mb-0.5 academic-label" style="font-size:9px;">Autor principal</p>
                                                <p class="text-sm font-semibold text-uni-navy-900">
                                                    {{ $article->student->name ?? 'Estudiante no registrado' }}
                                                </p>
                                                @if($article->students && $article->students != ($article->student->name ?? ''))
                                                    <p class="text-xs text-gray-400 mt-0.5">y otros colaboradores</p>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="mt-8">
                                            <a href="{{ route('profile.public.show', $article->student->id ?? 1) }}"
                                               class="inline-flex items-center gap-2 text-sm font-semibold text-uni-navy-700
                                                      hover:text-uni-gold-600 transition-colors group">
                                                Ver perfil del autor
                                                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Accent side -->
                                    <div class="hidden md:flex md:col-span-2 bg-uni-navy-900 items-center justify-center p-10 relative overflow-hidden">
                                        <!-- Academic grid pattern -->
                                        <div class="absolute inset-0 hero-academic-pattern opacity-50"></div>
                                        <!-- Gold corner accents -->
                                        <div class="absolute top-4 left-4 w-8 h-8 border-t-2 border-l-2 border-uni-gold-500/40 rounded-tl-sm"></div>
                                        <div class="absolute bottom-4 right-4 w-8 h-8 border-b-2 border-r-2 border-uni-gold-500/40 rounded-br-sm"></div>

                                        <div class="relative z-10 flex flex-col items-center gap-4 text-center">
                                            <div class="w-20 h-20 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center">
                                                <svg class="w-10 h-10 text-uni-gold-400/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                            </div>
                                            <p class="academic-label text-white/30" style="font-size:9px;">Investigación Aprobada</p>
                                            <div class="gold-rule-short"></div>
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
                            class="absolute -left-5 top-1/2 -translate-y-1/2 w-10 h-10 bg-white rounded-full
                                   shadow-md border border-gray-100 flex items-center justify-center
                                   text-uni-navy-500 hover:text-uni-gold-600 hover:border-uni-gold-200
                                   transition-all duration-200 hover:shadow-lg z-10">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </button>
                    <button @click="next()"
                            class="absolute -right-5 top-1/2 -translate-y-1/2 w-10 h-10 bg-white rounded-full
                                   shadow-md border border-gray-100 flex items-center justify-center
                                   text-uni-navy-500 hover:text-uni-gold-600 hover:border-uni-gold-200
                                   transition-all duration-200 hover:shadow-lg z-10">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>

                    <!-- Gold dots -->
                    <div class="flex justify-center mt-8 gap-2">
                        <template x-for="(slide, index) in totalSlides" :key="index">
                            <button @click="activeSlide = index"
                                    :class="activeSlide === index
                                        ? 'w-6 bg-uni-gold-400'
                                        : 'w-2 bg-uni-navy-200'"
                                    class="h-2 rounded-full transition-all duration-300">
                            </button>
                        </template>
                    </div>
                @endif

            </div>
        @else
            <div data-reveal class="max-w-4xl bg-white rounded-2xl border border-dashed border-uni-navy-100 p-16 text-center">
                <div class="w-16 h-16 rounded-2xl bg-uni-navy-50 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-uni-navy-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h3 class="font-serif text-lg font-bold text-uni-navy-700 mb-2">Sin investigaciones publicadas aún</h3>
                <p class="text-sm text-gray-400">Las investigaciones aprobadas aparecerán aquí.</p>
            </div>
        @endif

    </div>
</section>


<!-- ═══════════════════════════════════════════════════
     ACTUALIDAD Y EVENTOS
════════════════════════════════════════════════════ -->
<section class="py-28 bg-white border-t border-gray-100"
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
                 setTimeout(() => { document.body.style.overflow = 'auto'; }, 300);
             }
         }">
    <div class="max-w-7xl mx-auto px-6">

        <!-- Section header -->
        <div class="flex flex-col md:flex-row md:justify-between md:items-end mb-16 gap-6" data-reveal>
            <div>
                <span class="academic-label text-uni-gold-600 block mb-3">Vida Académica</span>
                <h2 class="font-serif text-4xl font-bold text-uni-navy-900 mb-4">
                    Actualidad y Eventos
                </h2>
                <div class="flex items-center gap-4">
                    <div class="gold-rule-short"></div>
                    <p class="text-gray-500 text-sm">
                        Noticias, avisos y convocatorias de la comunidad investigadora.
                    </p>
                </div>
            </div>
            <a href="{{ route('events.index') }}"
               class="inline-flex items-center gap-2 text-sm font-semibold text-uni-navy-700
                      hover:text-uni-gold-600 transition-colors group border-b border-transparent
                      hover:border-uni-gold-400 pb-0.5 self-start md:self-auto">
                Ver todos los eventos
                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        <!-- Events grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
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

            @forelse($feed as $index => $item)
                <article class="group cursor-pointer"
                         data-reveal="d{{ min($index + 1, 6) }}"
                         @click="openModal({{ json_encode($item) }})">

                    <!-- Thumbnail -->
                    <div class="aspect-video rounded-xl overflow-hidden bg-uni-navy-50 mb-5 relative shadow-sm">
                        <img src="{{ $item->image }}"
                             class="w-full h-full object-cover group-hover:scale-[1.04] transition-transform duration-500"
                             alt="{{ $item->title }}" loading="lazy">
                        <!-- Gradient overlay on hover -->
                        <div class="absolute inset-0 bg-gradient-to-t from-uni-navy-950/60 to-transparent
                                    opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                        @php
                            $badgeClass = match(true) {
                                $item->is_event          => 'bg-uni-navy-900 text-white',
                                $item->category === 'Aviso' => 'bg-uni-gold-400 text-uni-navy-950',
                                default                  => 'bg-uni-navy-800 text-white',
                            };
                        @endphp
                        <span class="absolute top-3 left-3 {{ $badgeClass }} text-[10px] font-bold uppercase tracking-widest px-2.5 py-1 rounded-sm">
                            {{ $item->category }}
                        </span>
                    </div>

                    <!-- Text -->
                    <div class="flex items-center gap-2 mb-2">
                        <div class="w-4 h-px bg-uni-gold-400/60"></div>
                        <p class="text-xs text-gray-400 font-medium">{{ $item->date }}</p>
                    </div>
                    <h3 class="font-serif text-base font-bold text-uni-navy-900 leading-snug
                                group-hover:text-uni-navy-700 transition-colors line-clamp-2 mb-2">
                        {{ $item->title }}
                    </h3>
                    @if($item->summary)
                        <p class="text-sm text-gray-500 line-clamp-2 leading-relaxed">
                            {{ $item->summary }}
                        </p>
                    @endif

                    <!-- Read more link -->
                    <div class="mt-3 inline-flex items-center gap-1.5 text-xs font-semibold text-uni-navy-500
                                group-hover:text-uni-gold-600 transition-colors">
                        Leer más
                        <svg class="w-3 h-3 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </article>

            @empty
                <div class="col-span-3 text-center py-20 border border-dashed border-uni-navy-100 rounded-2xl" data-reveal>
                    <div class="w-16 h-16 rounded-2xl bg-uni-navy-50 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-uni-navy-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                    </div>
                    <p class="font-serif text-base font-bold text-uni-navy-700 mb-1">Sin actualizaciones aún</p>
                    <p class="text-sm text-gray-400">Las noticias y eventos publicados aparecerán aquí.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- ── Modal ─────────────────────────────────────────── -->
    <template x-if="showModal">
        <div class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-8"
             x-transition:enter="transition ease-out duration-250"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">

            <!-- Backdrop -->
            <div class="absolute inset-0 bg-uni-navy-950/75 backdrop-blur-sm" @click="closeModal()"></div>

            <!-- Panel -->
            <div class="bg-white w-full max-w-3xl max-h-[90vh] rounded-2xl shadow-2xl relative z-10 overflow-hidden flex flex-col"
                 x-transition:enter="transition ease-out duration-250"
                 x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-98">

                <!-- Gold top accent bar -->
                <div class="h-1 bg-gradient-to-r from-uni-gold-400 via-uni-gold-300 to-uni-gold-500 flex-shrink-0"></div>

                <!-- Close -->
                <button @click="closeModal()"
                        class="absolute top-5 right-5 z-20 w-9 h-9 bg-uni-navy-100 hover:bg-uni-navy-200
                               rounded-full flex items-center justify-center text-uni-navy-600
                               transition-colors duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>

                <div class="overflow-y-auto flex-grow">
                    <!-- Image -->
                    <div class="w-full h-52 sm:h-64 relative flex-shrink-0">
                        <img :src="activeItem.image" class="w-full h-full object-cover" :alt="activeItem.title">
                        <div class="absolute inset-0 bg-gradient-to-t from-uni-navy-950/70 to-transparent"></div>
                    </div>

                    <!-- Content -->
                    <div class="p-8 sm:p-10">
                        <p class="academic-label text-uni-gold-600 mb-3"
                           x-text="activeItem.category + '  ·  ' + activeItem.date"></p>
                        <h2 class="font-serif text-2xl sm:text-3xl font-bold text-uni-navy-900 leading-tight mb-6"
                            x-text="activeItem.title"></h2>
                        <div class="w-12 h-0.5 bg-uni-gold-400 rounded mb-6"></div>
                        <div class="text-gray-600 text-base leading-relaxed whitespace-pre-line"
                             x-text="activeItem.content || activeItem.summary"></div>

                        <template x-if="activeItem.is_event">
                            <div class="mt-10 pt-6 border-t border-gray-100">
                                <a href="{{ route('events.index') }}"
                                   class="btn-uni-outline">
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


<!-- ═══════════════════════════════════════════════════
     CTA SECTION
════════════════════════════════════════════════════ -->
@guest
<section class="relative py-28 bg-uni-navy-900 overflow-hidden">
    <!-- Pattern background -->
    <div class="absolute inset-0 hero-academic-pattern opacity-60"></div>
    <div class="absolute inset-0 bg-gradient-to-br from-uni-navy-950/40 via-transparent to-uni-navy-800/40"></div>
    <!-- Decorative ring -->
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px]
                border border-uni-gold-500/8 rounded-full pointer-events-none"></div>

    <div class="relative z-10 max-w-3xl mx-auto px-6 text-center" data-reveal>
        <span class="academic-label text-uni-gold-400/80 block mb-5">Únete Hoy</span>
        <h2 class="font-serif text-4xl lg:text-5xl font-bold text-white mb-6">
            Forma Parte de la<br>
            <em class="text-shimmer not-italic">Comunidad Académica</em>
        </h2>
        <p class="text-white/50 text-lg mb-10 leading-relaxed">
            Registra tus investigaciones, conecta con asesores y contribuye al repositorio institucional de la UTP.
        </p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('register') }}" class="btn-uni-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                </svg>
                Crear Cuenta Institucional
            </a>
            <a href="{{ route('login') }}" class="btn-uni-secondary">
                Iniciar Sesión
            </a>
        </div>
    </div>
</section>
@endguest


<!-- ═══════════════════════════════════════════════════
     FOOTER
════════════════════════════════════════════════════ -->
<footer class="bg-uni-navy-950 text-white">
    <!-- Gold top accent -->
    <div class="h-px bg-gradient-to-r from-transparent via-uni-gold-500/40 to-transparent"></div>

    <div class="max-w-7xl mx-auto px-6 py-16">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12">

            <!-- Brand -->
            <div class="md:col-span-2">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-10 h-10 bg-uni-gold-400 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-uni-navy-950" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                        </svg>
                    </div>
                    <div>
                        <span class="font-serif text-lg font-bold text-white">UTP</span>
                        <span class="text-uni-gold-400 font-serif text-lg font-bold"> Académico</span>
                    </div>
                </div>
                <p class="text-white/40 text-sm leading-relaxed max-w-xs">
                    Plataforma oficial para la gestión, revisión y publicación de trabajos de investigación de la Universidad Tecnológica del Perú.
                </p>
                <!-- Gold separator -->
                <div class="mt-6 w-12 h-0.5 bg-uni-gold-500/50 rounded"></div>
            </div>

            <!-- Accesos -->
            <div>
                <h4 class="academic-label text-white/40 mb-5">Accesos</h4>
                <ul class="space-y-3 text-sm text-white/40">
                    <li><a href="#" class="hover:text-uni-gold-400 transition-colors duration-200">Portal UTP</a></li>
                    <li><a href="#" class="hover:text-uni-gold-400 transition-colors duration-200">Biblioteca Institucional</a></li>
                    <li><a href="#" class="hover:text-uni-gold-400 transition-colors duration-200">Formatos de Tesis</a></li>
                    <li><a href="{{ route('events.index') }}" class="hover:text-uni-gold-400 transition-colors duration-200">Eventos Científicos</a></li>
                </ul>
            </div>

            <!-- Soporte -->
            <div>
                <h4 class="academic-label text-white/40 mb-5">Soporte</h4>
                <ul class="space-y-3 text-sm text-white/40">
                    <li><a href="#" class="hover:text-uni-gold-400 transition-colors duration-200">Mesa de Ayuda</a></li>
                    <li><a href="#" class="hover:text-uni-gold-400 transition-colors duration-200">Preguntas Frecuentes</a></li>
                    <li><a href="#" class="hover:text-uni-gold-400 transition-colors duration-200">Contacto</a></li>
                </ul>
            </div>

        </div>

        <div class="mt-14 pt-8 border-t border-white/8 flex flex-col sm:flex-row
                    justify-between items-start sm:items-center gap-3">
            <p class="text-white/25 text-xs">
                &copy; {{ date('Y') }} Universidad Tecnológica del Perú. Todos los derechos reservados.
            </p>
            <p class="text-white/20 text-xs">
                Vía Simón Bolívar (Transístmica) — Campus Víctor Levi Sasso
            </p>
        </div>
    </div>
</footer>

</body>
</html>
