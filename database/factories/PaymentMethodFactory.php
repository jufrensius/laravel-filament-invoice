<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentMethodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'logo' => $this->faker->imageUrl(),
            'bank_name' => $this->faker->company,
            'account_name' => $this->faker->name,
            'account_number' => $this->faker->numerify('7#########'),
            'description' => $this->faker->paragraph,
        ];
    }
}
