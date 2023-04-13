<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $unit_price = $this->faker->randomFloat(2, 100000, 99900000);
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'unit_price' => number_format($unit_price, 2, '', ''),
        ];
    }
}
