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
    }
}
