<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->password()->create([
            'first_name' => 'richard',
            'last_name' => 'ocaranza',
            'email' => 'kodenook@pawcare.com'
        ]);

        if (@env('APP_ENV') !== 'production') {
            User::factory(5)->create();
            User::factory(4)->password()->create();
        }
    }
}
