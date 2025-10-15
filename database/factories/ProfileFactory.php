<?php

namespace Database\Factories;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{

    

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Profile::class;

    public function definition(): array
    {
        return [
            // 'user_id' sẽ được gán khi gọi từ UserFactory hoặc Seeder
            'address' => fake()->streetAddress() . ', ' . fake()->city(),
            'phone' => fake()->phoneNumber(),
        ];
    }
}
