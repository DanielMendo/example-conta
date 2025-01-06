<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Counter;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Receipt>
 */
class ReceiptFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'client_id' => Client::pluck('id')->random(),
            'counter_id' => Counter::pluck('id')->random(),
            'receipt_number' => $this->faker->unique()->uuid(),
            'amount' => $this->faker->numberBetween(100, 1000),
            'payment_method' => $this->faker->randomElement(['cash', 'cheque', 'transfer']),
            'payment_date' => $this->faker->date(),
            'description' => $this->faker->sentence(3),
            'status' => $this->faker->randomElement(['paid', 'pending', 'canceled']),
        ];
    }
}
