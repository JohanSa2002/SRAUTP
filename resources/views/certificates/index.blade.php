<x-app-layout>
    <x-slot name="header">
        {{ __('Mis Certificados') }}
    </x-slot>

    <div class="space-y-12 animate-in fade-in slide-in-from-bottom-4 duration-700 pb-20">

        <!-- Upload Section -->
        <div class="glass-card rounded-[2.5rem] p-8 md:p-10 border-l-8 border-cyber-purple-500 shadow-2xl shadow-cyber-purple-500/10">
            <div class="flex flex-col md:flex-row gap-10 items-start">
                <div class="md:w-1/3">
                    <h3 class="text-2xl font-black text-gray-900 uppercase tracking-tighter">Subir Certificado</h3>
                    @if(Auth::user()->isAdvisorRole())
                        <p class="text-sm text-gray-500 mt-2 leading-relaxed">Sube un certificado para ti mismo o asígnalo a uno de tus estudiantes ingresando su correo electrónico.</p>
                    @else
                        <p class="text-sm text-gray-500 mt-2 leading-relaxed">Sube tus certificados académicos para tenerlos siempre disponibles en tu perfil.</p>
                    @endif
                </div>

                <form action="{{ route('certificates.store') }}" method="POST" enctype="multipart/form-data" class="md:w-2/3 grid grid-cols-1 md:grid-cols-2 gap-6">
                    @csrf
                    <div class="md:col-span-2">
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Título del Certificado</label>
                        <input type="text" name="title" value="{{ old('title') }}" required placeholder="Ej: Certificado de Participación - Congreso 2026"
                            class="w-full bg-gray-50 border-gray-100 rounded-2xl px-5 py-3.5 focus:ring-4 focus:ring-cyber-purple-500/10 focus:border-cyber-purple-500 transition-all font-medium">
                        @error('title')
                            <p class="text-xs text-rose-500 font-bold mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    @if(Auth::user()->isAdvisorRole())
                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Correo del Estudiante (Opcional)</label>
                        <input type="email" name="student_email" value="{{ old('student_email') }}" placeholder="estudiante@correo.com"
                            class="w-full bg-gray-50 border-gray-100 rounded-2xl px-5 py-3.5 focus:ring-4 focus:ring-cyber-purple-500/10 focus:border-cyber-purple-500 transition-all font-medium">
                        <p class="text-[11px] text-gray-400 mt-2 font-medium">Déjalo vacío para asignarte el certificado a ti mismo.</p>
                        @error('student_email')
                            <p class="text-xs text-rose-500 font-bold mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    @endif

                    <div>
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Archivo (PDF o Imagen)</label>
                        <input type="file" name="file" required accept=".pdf,.jpg,.jpeg,.png"
                            class="w-full text-sm text-gray-500 file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 file:text-xs file:font-black file:uppercase file:bg-gray-100 file:text-gray-600 hover:file:bg-gray-200 transition-all">
                        @error('file')
                            <p class="text-xs text-rose-500 font-bold mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2">Breve Descripción (Opcional)</label>
                        <textarea name="description" rows="2"
                            class="w-full bg-gray-50 border-gray-100 rounded-2xl px-5 py-3.5 focus:ring-4 focus:ring-cyber-purple-500/10 focus:border-cyber-purple-500 transition-all font-medium"
                            placeholder="Ej: Otorgado por participar en la feria de investigación...">{{ old('description') }}</textarea>
                    </div>

                    <div class="md:col-span-2 text-right">
                        <button type="submit" class="px-10 py-4 bg-gray-900 text-white rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-cyber-purple-600 hover:-translate-y-1 hover:shadow-xl hover:shadow-cyber-purple-500/30 transition-all">
                            Subir Certificado
                        </button>
                    </div>
                </form>
            </div>
        </div>

        @if(session('success'))
        <div class="glass-card px-6 py-4 rounded-2xl border-l-4 border-green-500 bg-green-50/50 flex items-center justify-between">
            <span class="text-sm font-bold text-green-700">{{ session('success') }}</span>
            <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
        </div>
        @endif

        <!-- My Certificates -->
        <section class="space-y-6">
            <div class="flex items-center space-x-4 ml-4">
                <div class="w-1.5 h-8 bg-cyber-purple-500 rounded-full"></div>
                <h2 class="text-2xl font-black text-gray-900 uppercase tracking-tighter">Mis Certificados</h2>
            </div>

            @if($myCertificates->isEmpty())
            <div class="flex flex-col items-center justify-center py-20 text-center opacity-30">
                <svg class="w-20 h-20 text-gray-400 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                <h3 class="text-2xl font-black text-gray-900 uppercase tracking-tighter">Sin Certificados</h3>
                <p class="text-gray-500 mt-2 font-medium italic">Aún no tienes certificados registrados.</p>
            </div>
            @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($myCertificates as $certificate)
                <div class="group glass-card p-8 rounded-[2rem] hover:bg-white hover:shadow-2xl hover:shadow-cyber-purple-500/10 transition-all duration-500 border border-transparent hover:border-cyber-purple-100 flex flex-col h-full relative overflow-hidden">

                    <!-- Background decoration -->
                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-gray-50 rounded-full group-hover:bg-cyber-purple-50 transition-colors duration-500"></div>

                    <div class="relative z-10 flex-grow">
                        <div class="flex items-start justify-between mb-6">
                            <div class="w-14 h-14 bg-white shadow-inner rounded-2xl flex items-center justify-center text-cyber-purple-500 border border-gray-50 group-hover:border-cyber-purple-200 transition-all duration-500">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                            </div>

                            @if(Auth::user()->id === $certificate->user_id || Auth::user()->id === $certificate->uploaded_by || Auth::user()->is_admin)
                            <form action="{{ route('certificates.destroy', $certificate) }}" method="POST" onsubmit="return confirm('¿Eliminar este certificado permanentemente?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-gray-300 hover:text-rose-500 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                            @endif
                        </div>

                        <h4 class="text-xl font-bold text-gray-900 mb-3 leading-tight group-hover:text-cyber-purple-600 transition-colors">{{ $certificate->title }}</h4>
                        @if($certificate->description)
                        <p class="text-sm text-gray-500 leading-relaxed mb-4">{{ $certificate->description }}</p>
                        @endif
                        <p class="text-xs text-gray-400 font-medium mb-8">
                            @if($certificate->uploaded_by && $certificate->uploaded_by !== $certificate->user_id)
                                Emitido por {{ $certificate->uploader->name ?? 'Usuario eliminado' }} ·
                            @endif
                            {{ $certificate->created_at->format('d/m/Y') }}
                        </p>
                    </div>

                    <div class="mt-auto relative z-10 pt-6 border-t border-gray-50 group-hover:border-cyber-purple-50 transition-colors">
                        <a href="{{ asset('storage/' . $certificate->file_path) }}" target="_blank"
                            class="flex items-center justify-between w-full px-6 py-4 bg-gray-50 group-hover:bg-cyber-purple-500 text-gray-700 group-hover:text-white rounded-2xl font-bold text-xs uppercase tracking-widest transition-all duration-300">
                            <span>Ver Certificado</span>
                            <svg class="w-4 h-4 translate-x-0 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </section>

        <!-- Certificates issued to students (advisor & assistant only) -->
        @if(Auth::user()->isAdvisorRole())
        <section class="space-y-6">
            <div class="flex items-center space-x-4 ml-4">
                <div class="w-1.5 h-8 bg-indigo-500 rounded-full"></div>
                <h2 class="text-2xl font-black text-gray-900 uppercase tracking-tighter">Certificados Emitidos a Estudiantes</h2>
            </div>

            @if($issuedCertificates->isEmpty())
            <p class="text-gray-400 font-medium italic ml-4">Aún no has emitido certificados a tus estudiantes.</p>
            @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($issuedCertificates as $certificate)
                <div class="group glass-card p-8 rounded-[2rem] hover:bg-white hover:shadow-2xl hover:shadow-indigo-500/10 transition-all duration-500 border border-transparent hover:border-indigo-100 flex flex-col h-full relative overflow-hidden">

                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-gray-50 rounded-full group-hover:bg-indigo-50 transition-colors duration-500"></div>

                    <div class="relative z-10 flex-grow">
                        <div class="flex items-start justify-between mb-6">
                            <div class="w-14 h-14 bg-white shadow-inner rounded-2xl flex items-center justify-center text-indigo-500 border border-gray-50 group-hover:border-indigo-200 transition-all duration-500">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            </div>

                            <form action="{{ route('certificates.destroy', $certificate) }}" method="POST" onsubmit="return confirm('¿Eliminar este certificado permanentemente?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-gray-300 hover:text-rose-500 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>

                        <h4 class="text-xl font-bold text-gray-900 mb-2 leading-tight group-hover:text-indigo-600 transition-colors">{{ $certificate->title }}</h4>
                        <p class="text-sm font-bold text-indigo-500 mb-3">Para: {{ $certificate->owner->name ?? 'Usuario eliminado' }}</p>
                        @if($certificate->description)
                        <p class="text-sm text-gray-500 leading-relaxed mb-4">{{ $certificate->description }}</p>
                        @endif
                        <p class="text-xs text-gray-400 font-medium mb-8">{{ $certificate->created_at->format('d/m/Y') }}</p>
                    </div>

                    <div class="mt-auto relative z-10 pt-6 border-t border-gray-50 group-hover:border-indigo-50 transition-colors">
                        <a href="{{ asset('storage/' . $certificate->file_path) }}" target="_blank"
                            class="flex items-center justify-between w-full px-6 py-4 bg-gray-50 group-hover:bg-indigo-500 text-gray-700 group-hover:text-white rounded-2xl font-bold text-xs uppercase tracking-widest transition-all duration-300">
                            <span>Ver Certificado</span>
                            <svg class="w-4 h-4 translate-x-0 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </section>
        @endif

    </div>
</x-app-layout>
