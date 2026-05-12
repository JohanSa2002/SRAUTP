<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Usuario Administrador
        User::factory()->create([
            'name' => 'Admin UTP',
            'email' => 'admin@utp.ac.pa',
            'institutional_email' => 'admin@utp.ac.pa',
            'cedula' => '1-000-0000',
            'password' => Hash::make('password'),
            'is_admin' => true,
            'is_advisor' => false,
        ]);

        // 2. Usuario Asesor
        $advisor = User::factory()->create([
            'name' => 'Asesor Académico',
            'email' => 'asesor@utp.ac.pa',
            'institutional_email' => 'asesor@utp.ac.pa',
            'cedula' => '2-000-0000',
            'password' => Hash::make('password'),
            'is_admin' => false,
            'is_advisor' => true,
        ]);

        // 3. Usuario Estudiante
        User::factory()->create([
            'name' => 'Estudiante UTP',
            'email' => 'estudiante@utp.ac.pa',
            'institutional_email' => 'estudiante@utp.ac.pa',
            'cedula' => '3-000-0000',
            'password' => Hash::make('password'),
            'is_admin' => false,
            'is_advisor' => false,
        ]);

        // 4. Eventos
        $events = \App\Models\Event::factory(3)->create();

        // 5. Noticias
        \App\Models\Notice::factory(5)->create();

        // 6. Recursos de Librería
        \App\Models\LibraryResource::factory(4)->create();

        // 7. Artículos de prueba
        \App\Models\Article::factory(10)->create([
            'advisor_id' => $advisor->id,
            'event_id' => $events->random()->id,
        ]);

        // Generar algunos adicionales para bulto
        User::factory(5)->create();
    }
}
