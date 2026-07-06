<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\Priority;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create('ja_JP');

        return [
            'title' => $faker->sentence(3),
            'description' => $faker->realText(20),
            'priority' => $faker->randomElement(Priority::cases()),
            'due_date' => $faker->dateTimeBetween('now', '+1 week'),
            'completed_at' => null,
            'user_id' => User::factory(),
        ];
    }
}
