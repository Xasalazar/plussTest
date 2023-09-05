<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\Section::factory()->create([
            'name' => 'Terror',
            'description' => 'Descricion de prubea',
        ]);
        \App\Models\Section::factory()->create([
            'name' => 'Romance',
            'description' => 'Descricion de prubea',
        ]);
        \App\Models\Section::factory()->create([
            'name' => 'Drama',
            'description' => 'Descricion de prubea',
        ]);
        \App\Models\Section::factory()->create([
            'name' => 'Manga',
            'description' => 'Descricion de prubea',
        ]);
        \App\Models\Section::factory()->create([
            'name' => 'Accion',
            'description' => 'Descricion de prubea',
        ]);
        \App\Models\Section::factory()->create([
            'name' => 'Historico',
            'description' => 'Descricion de prubea',
        ]);
        \App\Models\User::factory()->create([
            'email' => 'test@example.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ]);

        \App\Models\Executive::factory()->create([
            'name' => 'Usuario',
            'lastname' => 'de Ingreso',
            'phone' => '0989804000',
            'document' => '0999999991'
        ]);
    }
}
