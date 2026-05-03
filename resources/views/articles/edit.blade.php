<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Artículo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/80 backdrop-blur-md overflow-hidden shadow-sm sm:rounded-lg border border-purple-100">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('articles.update', $article) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <!-- Title -->
                        <div>
                            <x-input-label for="title" :value="__('Título del Artículo')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                                :value="old('title', $article->title)" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Students -->
                        <div class="mt-4">
                            <x-input-label for="students" :value="__('Estudiantes Participantes')" />
                            <x-text-input id="students" class="block mt-1 w-full" type="text" name="students"
                                :value="old('students', $article->students)" required />
                            <x-input-error :messages="$errors->get('students')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-2 gap-4 mt-4">
                            <!-- Year -->
                            <div>
                                <x-input-label for="year" :value="__('Año')" />
                                <x-text-input id="year" class="block mt-1 w-full" type="number" name="year"
                                    :value="old('year', $article->year)" required />
                                <x-input-error :messages="$errors->get('year')" class="mt-2" />
                            </div>

                            <!-- Career -->
                            <div>
                                <x-input-label for="career" :value="__('Carrera')" />
                                <x-text-input id="career" class="block mt-1 w-full" type="text" name="career"
                                    :value="old('career', $article->career)" required />
                                <x-input-error :messages="$errors->get('career')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Student Assignment via Email (For Advisors and Assistants) -->
                        @if(Auth::user()->isAdvisorRole())
                            <div class="mt-4">
                                <x-input-label for="student_email" :value="__('Email del Estudiante (Para asignar)')" />
                                <x-text-input id="student_email" class="block mt-1 w-full" type="email" name="student_email"
                                    :value="old('student_email', $article->student->email)" required />
                                <p class="mt-1 text-sm text-gray-500 italic">Puedes cambiar el estudiante asignado a este artículo.</p>
                                <x-input-error :messages="$errors->get('student_email')" class="mt-2" />
                            </div>
                        @endif

                        <!-- Advisor Selection (Only if student or admin) -->
                        @if(!Auth::user()->isAdvisorRole())
                            <div class="mt-4">
                                <x-input-label for="advisor_id" :value="__('Asesor')" />
                                <select id="advisor_id" name="advisor_id"
                                    class="block mt-1 w-full border-gray-300 focus:border-purple-500 focus:ring-purple-500 rounded-md shadow-sm"
                                    required>
                                    @foreach($advisors as $advisor)
                                        <option value="{{ $advisor->id }}" {{ old('advisor_id', $article->advisor_id) == $advisor->id ? 'selected' : '' }}>{{ $advisor->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('advisor_id')" class="mt-2" />
                            </div>
                        @endif

                        <!-- Event Selection -->
                        <div class="mt-4 p-4 bg-cyber-purple-50/30 rounded-2xl border border-cyber-purple-100/50">
                            <h4 class="text-xs font-black uppercase tracking-widest text-cyber-purple-600 mb-4">Inscripción a Concurso (Opcional)</h4>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="event_id" :value="__('Evento')" class="text-[10px] font-black uppercase mb-1" />
                                    <select id="event_id" name="event_id"
                                        class="block w-full border-gray-200 focus:border-cyber-purple-500 focus:ring-cyber-purple-500 rounded-xl shadow-sm text-sm"
                                        onchange="updateCategories()">
                                        <option value="">Sin definir (Revisión normal)</option>
                                        @foreach($events as $event)
                                            <option value="{{ $event->id }}" 
                                                data-categories="{{ json_encode($event->categories) }}"
                                                {{ old('event_id', $article->event_id) == $event->id ? 'selected' : '' }}>
                                                {{ $event->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('event_id')" class="mt-2" />
                                </div>

                                <div id="category_container" style="display: none;">
                                    <x-input-label for="event_category" :value="__('Categoría')" class="text-[10px] font-black uppercase mb-1" />
                                    <select id="event_category" name="event_category"
                                        class="block w-full border-gray-200 focus:border-cyber-purple-500 focus:ring-cyber-purple-500 rounded-xl shadow-sm text-sm">
                                        <option value="">Seleccione categoría</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('event_category')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <!-- PDF Upload (Optional in Edit) -->
                        <div class="mt-4 p-4 bg-purple-50 rounded-lg border border-purple-100">
                            <x-input-label for="pdf_file" :value="__('Actualizar Archivo PDF (Opcional)')" />
                            <input id="pdf_file"
                                class="block mt-1 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none"
                                type="file" name="pdf_file" accept=".pdf" />
                            <p class="mt-1 text-xs text-gray-500 italic">Deja en blanco para conservar el archivo
                                actual.</p>

                            <div class="mt-2 flex items-center">
                                <a href="{{ asset('storage/' . $article->pdf_path) }}" target="_blank"
                                    class="text-xs text-purple-600 underline font-medium">Ver archivo actual</a>
                            </div>
                            <x-input-error :messages="$errors->get('pdf_file')" class="mt-2" />
                        </div>

                        <script>
                            function updateCategories() {
                                const eventSelect = document.getElementById('event_id');
                                const categoryContainer = document.getElementById('category_container');
                                const categorySelect = document.getElementById('event_category');
                                
                                const selectedOption = eventSelect.options[eventSelect.selectedIndex];
                                
                                if (selectedOption.value) {
                                    const categories = JSON.parse(selectedOption.getAttribute('data-categories'));
                                    
                                    // Limpiar y llenar
                                    categorySelect.innerHTML = '<option value="">Seleccione categoría</option>';
                                    categories.forEach(cat => {
                                        const option = document.createElement('option');
                                        option.value = cat;
                                        option.textContent = cat;
                                        if ("{{ old('event_category', $article->event_category) }}" === cat) {
                                            option.selected = true;
                                        }
                                        categorySelect.appendChild(option);
                                    });
                                    
                                    categoryContainer.style.display = 'block';
                                    categorySelect.disabled = false;
                                } else {
                                    categoryContainer.style.display = 'none';
                                    categorySelect.disabled = true;
                                }
                            }

                            document.addEventListener('DOMContentLoaded', updateCategories);
                        </script>

                        <div class="flex items-center justify-end mt-6 gap-3">
                            <a href="{{ route('articles.show', $article) }}"
                                class="text-sm text-gray-600 hover:text-gray-900">Cancelar</a>
                            <x-primary-button>
                                {{ __('Actualizar Artículo') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>