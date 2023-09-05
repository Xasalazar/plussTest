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
        \App\Models\Section::factory()->create([
            'name' => 'Comics',
            'description' => 'Descricion de prubea',
        ]);
        \App\Models\Section::factory()->create([
            'name' => 'Aventura',
            'description' => 'Descricion de prubea',
        ]);
        \App\Models\Section::factory()->create([
            'name' => 'Mundo',
            'description' => 'Descricion de prubea',
        ]);
        \App\Models\Section::factory()->create([
            'name' => 'Ficcion',
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

        \App\Models\Reader::factory()->create([
            'name' => 'Persona 1',
            'lastname' => 'Persona 1',
            'phone' => '0989804000',
            'document' => '0999999991'
        ]);
        \App\Models\Reader::factory()->create([
            'name' => 'Persona 2',
            'lastname' => 'Persona 2',
            'phone' => '0989804000',
            'document' => '0999999992'
        ]);
        \App\Models\Reader::factory()->create([
            'name' => 'Persona 3',
            'lastname' => 'Persona 3',
            'phone' => '0989804000',
            'document' => '0999999993'
        ]);
        \App\Models\Reader::factory()->create([
            'name' => 'Persona 4',
            'lastname' => 'Persona 4',
            'phone' => '0989804000',
            'document' => '0999999994'
        ]);
        \App\Models\Reader::factory()->create([
            'name' => 'Persona 5',
            'lastname' => 'Persona 5',
            'phone' => '0989804000',
            'document' => '0999999995'
        ]);

        \App\Models\Book::factory(50)->create();
    }
}
