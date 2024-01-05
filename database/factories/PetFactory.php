<?php

namespace Database\Factories;

use App\Models\Breed;
use App\Models\Type;
use App\Models\User;
use Database\Providers\AnimalProvider;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pet>
 */
class PetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        fake()->addProvider(new AnimalProvider(fake()));

        $totalUsers = User::get('id')->count();
        $totalBreeds = Breed::get(['id', 'type_id'])->toArray();
        $breed = fake()->numberBetween(1, count($totalBreeds) - 1);

        return [
            'name' => fake()->unique()->nameAnimal(),
            'user_id' => fake()->numberBetween(1, $totalUsers),
            'type_id' => $totalBreeds[$breed]['type_id'],
            'breed_id' => $totalBreeds[$breed]['id']
        ];
    }
}
