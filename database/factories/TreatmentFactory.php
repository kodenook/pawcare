<?php

namespace Database\Factories;

use App\Models\Pet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Treatment>
 */
class TreatmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $totalPets = Pet::get('id')->count();

        return [
            'title' => fake()->words(3, true),
            'prescription' => fake()->paragraph(),
            'pet_id' => fake()->randomNumber(1, $totalPets)
        ];
    }
}
