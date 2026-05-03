<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalles del Artículo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-bold mb-4">Información General</h3>
                            <p><strong>Título:</strong> {{ $article->title }}</p>
                            <p><strong>Estudiantes:</strong> {{ $article->students }}</p>
                            <p><strong>Año:</strong> {{ $article->year }}</p>
                            <p><strong>Carrera:</strong> {{ $article->career }}</p>
                            <p><strong>Estatus Actual:</strong>
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($article->status == 'aprobado') bg-green-100 text-green-800 
                                    @elseif($article->status == 'revisión') bg-yellow-100 text-yellow-800 
                                    @else bg-red-100 text-red-800 @endif">
                                    {{ ucfirst($article->status) }}
                                </span>
                            </p>

                            @if($article->event_id)
                                <div class="mt-6 p-4 bg-cyber-purple-50 rounded-2xl border border-cyber-purple-100">
                                    <h4 class="text-[10px] font-black uppercase tracking-widest text-cyber-purple-600 mb-2">Evento Inscrito</h4>
                                    <p class="font-black text-gray-900 leading-tight uppercase">{{ $article->event->name }}</p>
                                    <div class="mt-2 inline-block px-3 py-1 bg-cyber-purple-600 text-white text-[10px] font-black rounded-lg uppercase tracking-tight">
                                        Categoría: {{ $article->event_category }}
                                    </div>
                                </div>
                            @endif

                            <div class="mt-6 flex flex-wrap gap-3">
                                <a href="{{ asset('storage/' . $article->pdf_path) }}" target="_blank"
                                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Ver PDF Completo
                                </a>

                                @php
                                    $canEdit = Auth::id() === $article->user_id
                                        || Auth::id() === $article->advisor_id
                                        || Auth::user()->is_admin
                                        || (Auth::user()->is_advisor_assistant && $article->advisor_id === Auth::user()->parent_advisor_id);
                                @endphp
                                @if($canEdit)
                                    <a href="{{ route('articles.edit', $article) }}"
                                        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Editar Artículo
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div>
                            @php
                            $canEvaluate = (Auth::user()->is_advisor && Auth::id() === $article->advisor_id)
                                || (Auth::user()->is_advisor_assistant && $article->advisor_id === Auth::user()->parent_advisor_id);
                        @endphp
                        @if($canEvaluate)
                                <h3 class="text-lg font-bold mb-4">Evaluar Artículo</h3>
                                <form method="POST" action="{{ route('articles.evaluate', $article) }}">
                                    @csrf
                                    @method('PATCH')

                                    <div>
                                        <x-input-label for="status" :value="__('Cambiar Estatus')" />
                                        <select id="status" name="status"
                                            class="block mt-1 w-full border-gray-300 focus:border-purple-500 focus:ring-purple-500 rounded-md shadow-sm">
                                            <option value="aprobado" {{ $article->status == 'aprobado' ? 'selected' : '' }}>
                                                Aprobado</option>
                                            <option value="revisión" {{ $article->status == 'revisión' ? 'selected' : '' }}>
                                                Revisión</option>
                                            <option value="rechazado" {{ $article->status == 'rechazado' ? 'selected' : '' }}>
                                                Rechazado</option>
                                        </select>
                                    </div>

                                    <div class="mt-4">
                                        <x-input-label for="comments" :value="__('Comentarios / Observaciones')" />
                                        <textarea id="comments" name="comments" rows="4"
                                            class="block mt-1 w-full border-gray-300 focus:border-purple-500 focus:ring-purple-500 rounded-md shadow-sm"
                                            placeholder="Escriba sus observaciones aquí...">{{ old('comments', $article->comments) }}</textarea>
                                    </div>

                                    <div class="mt-4">
                                        <x-primary-button>
                                            Guardar Evaluación
                                        </x-primary-button>
                                    </div>
                                </form>
                            @else
                                <h3 class="text-lg font-bold mb-4">Retroalimentación</h3>
                                @if($article->comments)
                                    <div class="p-4 bg-gray-50 rounded-lg italic border-l-4 border-purple-500">
                                        "{{ $article->comments }}"
                                    </div>
                                @else
                                    <p class="text-gray-500">No hay comentarios aún.</p>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>