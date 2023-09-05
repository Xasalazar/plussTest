<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // $faker = Faker::create();

        return [
            'section_id' => fake()->numberBetween(1, 10), // Ejemplo: un número aleatorio entre 1 y 10
            'title' => fake()->sentence,
            'description' => fake()->paragraph,
            'number_page' => fake()->numberBetween(50, 500), // Ejemplo: un número aleatorio entre 50 y 500
            'publication_date' => fake()->date,
        ];
    }
}
