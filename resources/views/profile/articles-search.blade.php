<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mis Artículos y Tesis') }}
        </h2>
    </x-slot>

    <div class="space-y-6 animate-in fade-in slide-in-from-bottom-4 duration-700">
        <div class="glass-card rounded-3xl overflow-hidden">
            <div class="p-6 border-b border-white/20 bg-white/30">
                <h3 class="font-bold text-gray-800 text-lg mb-1">Buscador de Investigaciones</h3>
                <p class="text-sm text-gray-500 mb-5">{{ $subtitle }}</p>

                <form method="GET" action="{{ route('profile.edit') }}" class="flex gap-3">
                    <div class="flex-1 relative">
                        <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input
                            type="text"
                            name="search"
                            value="{{ $search }}"
                            placeholder="Buscar por título, estudiantes, carrera o año..."
                            class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-xl focus:border-cyber-purple-500 focus:ring-cyber-purple-500 text-sm"
                            autofocus
                        />
                    </div>
                    <button type="submit"
                        class="px-4 py-2 bg-cyber-purple-600 text-white text-sm font-semibold rounded-xl hover:bg-cyber-purple-700 transition-colors">
                        Buscar
                    </button>
                    @if($search)
                        <a href="{{ route('profile.edit') }}"
                            class="px-4 py-2 bg-gray-100 text-gray-600 text-sm font-semibold rounded-xl hover:bg-gray-200 transition-colors">
                            Limpiar
                        </a>
                    @endif
                </form>
            </div>

            @if($search !== '')
                <div class="overflow-x-auto">
                    @if($advisorArticles->isEmpty())
                        <div class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center">
                                <div class="bg-gray-50 p-4 rounded-full mb-4">
                                    <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <span class="text-gray-400 font-medium">No se encontraron artículos para "{{ $search }}".</span>
                            </div>
                        </div>
                    @else
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-50/50 text-left">
                                    <th class="px-6 py-3 text-xs font-bold text-gray-400 uppercase tracking-widest">Título</th>
                                    <th class="px-6 py-3 text-xs font-bold text-gray-400 uppercase tracking-widest hidden md:table-cell">Estudiantes</th>
                                    <th class="px-6 py-3 text-xs font-bold text-gray-400 uppercase tracking-widest hidden lg:table-cell">Año</th>
                                    <th class="px-6 py-3 text-xs font-bold text-gray-400 uppercase tracking-widest">Estado</th>
                                    <th class="px-6 py-3 text-xs font-bold text-gray-400 uppercase tracking-widest text-right">Ver</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100/50">
                                @foreach($advisorArticles as $article)
                                    <tr class="hover:bg-cyber-purple-50/30 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="font-semibold text-gray-800 line-clamp-1">{{ $article->title }}</div>
                                            <div class="text-xs text-gray-400 mt-0.5">{{ $article->career }}</div>
                                        </td>
                                        <td class="px-6 py-4 hidden md:table-cell">
                                            <span class="text-sm text-gray-600">{{ $article->students }}</span>
                                        </td>
                                        <td class="px-6 py-4 hidden lg:table-cell">
                                            <span class="px-2 py-1 bg-gray-100 rounded-full text-xs font-bold text-gray-500">{{ $article->year }}</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold
                                                @if($article->status === 'aprobado') bg-green-100 text-green-700
                                                @elseif($article->status === 'revisión') bg-yellow-100 text-yellow-700
                                                @else bg-red-100 text-red-700 @endif">
                                                <span class="w-1.5 h-1.5 rounded-full mr-1.5
                                                    @if($article->status === 'aprobado') bg-green-500
                                                    @elseif($article->status === 'revisión') bg-yellow-500
                                                    @else bg-red-500 @endif"></span>
                                                {{ ucfirst($article->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <a href="{{ route('articles.show', $article) }}"
                                                class="p-2 inline-flex hover:bg-white rounded-xl text-gray-400 hover:text-cyber-purple-500 transition-all hover:shadow-sm"
                                                title="Ver artículo">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="px-6 py-3 bg-gray-50/50 border-t border-gray-100 text-xs text-gray-400 font-medium">
                            {{ $advisorArticles->count() }} resultado(s) para "<strong>{{ $search }}</strong>"
                        </div>
                    @endif
                </div>
            @else
                <div class="px-6 py-14 text-center text-sm text-gray-400">
                    Escribe algo en el buscador para ver los artículos relacionados.
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
