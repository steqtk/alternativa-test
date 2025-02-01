<?php

namespace Database\Factories;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'amount' => $this->faker->randomFloat(2, -500, 500),
            'description' => $this->faker->sentence,
        ];
    }
}
