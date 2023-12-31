<?php

namespace Database\Factories;

use App\Models\Type;
use Database\Providers\AnimalProvider;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Breed>
 */
class BreedFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $totalTypes = Type::get('id')->count();

        fake()->addProvider(new AnimalProvider(fake()));

        return [
            'name' => fake()->unique()->breedAnimal(),
            'type_id' => fake()->numberBetween(1, $totalTypes)
        ];
    }
}
