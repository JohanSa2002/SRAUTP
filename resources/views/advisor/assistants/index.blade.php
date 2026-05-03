<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mis Asistentes') }}
        </h2>
    </x-slot>

    <div class="space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-700">

        @if(session('success'))
            <div class="p-4 bg-green-50 border border-green-200 rounded-2xl text-green-800 text-sm font-medium">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <!-- Crear nueva cuenta de asistente -->
            <div class="glass-card p-6 rounded-3xl">
                <h3 class="font-bold text-gray-800 mb-1">Crear nueva cuenta de asistente</h3>
                <p class="text-sm text-gray-500 mb-5">Crea una cuenta nueva directamente asignada como tu asistente.</p>

                <form method="POST" action="{{ route('advisor.assistants.store-new') }}" class="space-y-4">
                    @csrf

                    <div>
                        <x-input-label for="name" value="Nombre completo" />
                        <x-text-input id="name" name="name" type="text" class="block mt-1 w-full"
                            :value="old('name')" placeholder="Ej: María López" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-1" />
                    </div>

                    <div>
                        <x-input-label for="cedula" value="Cédula" />
                        <x-text-input id="cedula" name="cedula" type="text" class="block mt-1 w-full"
                            :value="old('cedula')" placeholder="Ej: 8-123-456" required />
                        <x-input-error :messages="$errors->get('cedula')" class="mt-1" />
                    </div>

                    <div>
                        <x-input-label for="email" value="Correo electrónico" />
                        <x-text-input id="email" name="email" type="email" class="block mt-1 w-full"
                            :value="old('email')" placeholder="correo@ejemplo.com" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    <div>
                        <x-input-label for="password" value="Contraseña" />
                        <x-text-input id="password" name="password" type="password" class="block mt-1 w-full"
                            placeholder="Mínimo 8 caracteres" required />
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>

                    <div>
                        <x-input-label for="password_confirmation" value="Confirmar contraseña" />
                        <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                            class="block mt-1 w-full" placeholder="Repite la contraseña" required />
                    </div>

                    <div class="pt-2">
                        <x-primary-button class="w-full justify-center">
                            Crear cuenta de asistente
                        </x-primary-button>
                    </div>
                </form>
            </div>

            <!-- Asignar usuario existente -->
            <div class="glass-card p-6 rounded-3xl">
                <h3 class="font-bold text-gray-800 mb-1">Asignar usuario existente</h3>
                <p class="text-sm text-gray-500 mb-5">Asigna a un usuario ya registrado en la plataforma como tu asistente.</p>

                <form method="POST" action="{{ route('advisor.assistants.store') }}" class="space-y-4">
                    @csrf

                    <div>
                        <x-input-label for="existing_email" value="Correo del usuario" />
                        <x-text-input id="existing_email" name="email" type="email" class="block mt-1 w-full"
                            :value="old('email')" placeholder="correo@ejemplo.com" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    <div class="pt-2">
                        <x-primary-button class="w-full justify-center">
                            Agregar asistente
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Lista de asistentes activos -->
        <div class="glass-card rounded-3xl overflow-hidden">
            <div class="p-6 border-b border-white/20 bg-white/30">
                <h3 class="font-bold text-gray-800 flex items-center space-x-2">
                    <svg class="w-5 h-5 text-cyber-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span>Asistentes activos ({{ $assistants->count() }})</span>
                </h3>
            </div>

            @forelse($assistants as $assistant)
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100/50 hover:bg-cyber-purple-50/30 transition-colors">
                    <div class="flex items-center space-x-4">
                        <div class="h-10 w-10 rounded-full bg-gradient-to-tr from-cyber-purple-400 to-indigo-500 flex items-center justify-center text-white font-bold text-sm shadow-sm">
                            {{ strtoupper(substr($assistant->name, 0, 1)) }}
                        </div>
                        <div>
                            <div class="font-semibold text-gray-800">{{ $assistant->name }}</div>
                            <div class="text-xs text-gray-500">{{ $assistant->email }}</div>
                            <div class="text-xs text-gray-400">Cédula: {{ $assistant->cedula }}</div>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('advisor.assistants.destroy', $assistant) }}"
                        onsubmit="return confirm('¿Quitar a {{ $assistant->name }} como asistente?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="text-xs font-semibold text-red-500 hover:text-red-700 px-3 py-1.5 rounded-lg hover:bg-red-50 transition-colors">
                            Quitar
                        </button>
                    </form>
                </div>
            @empty
                <div class="px-6 py-16 text-center">
                    <div class="flex flex-col items-center">
                        <div class="bg-gray-50 p-4 rounded-full mb-4">
                            <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                        </div>
                        <span class="text-gray-400 font-medium">No tienes asistentes registrados aún.</span>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
