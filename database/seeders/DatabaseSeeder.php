<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         $this->call([
            // Seeder MỚI cho Category và Product
            // CategoryProductSeeder::class,

            // Seeder đã tạo trước đó cho User và Profile
            UserProfilesSeeder::class,

            // Seeder của bạn (giữ nguyên)
            // StudentCourseSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

    }
}
