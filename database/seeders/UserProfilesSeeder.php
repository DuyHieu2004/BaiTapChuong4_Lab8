<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserProfilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
               // 2. Tạo 1 User cố định cho việc đăng nhập/kiểm thử
        User::factory()->create([
            'name' => 'Demo User',
            'email' => 'demo@example.com',
            'password' => bcrypt('password'), // Dùng password cố định
        ])->profile()->create( // Tự động tạo 1 Profile cho Demo User này
            Profile::factory()->make()->toArray()
        );

        // 3. Tạo 10 User ngẫu nhiên khác
        User::factory(10)
            ->create()
            // 4. Eager Load (tải nhanh) để tạo 1 Profile cho MỖI User
            ->each(function ($user) {
                $user->profile()->create(
                    Profile::factory()->make()->toArray()
                );
            });

        $this->command->info('Đã tạo 11 User và 11 Profile thành công.');
    }
}
