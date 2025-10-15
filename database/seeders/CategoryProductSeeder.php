<?php

namespace Database\Seeders;

use App\Models\Category; // Cần import Model Category
use Illuminate\Database\Seeder;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Category::factory()
            ->count(5)
            ->hasProducts(10) // Giả định bạn có định nghĩa quan hệ 'products' trong Category Model
            ->create();

        $this->command->info('Đã tạo 5 Category và 50 Product thành công.');

    }
}
