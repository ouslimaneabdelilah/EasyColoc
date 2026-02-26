<?php

namespace Database\Factories;

use App\Models\Expense;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Settlement>
 */
class SettlementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'expense_id' => Expense::inRandomOrder()->first()->id ?? Expense::factory(),
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
            'amount' => fake()->randomFloat(2, 5, 200),
            'status' => fake()->randomElement(['pending', 'paid']),
        ];
    }
}
