<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductTagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $parent_id = rand(1, 10);
        return [
            'name' => $this->faker->unique()->word,
            'parent_product_tag_id' => ($parent_id % 2 != 0) ? $parent_id++ : null,
        ];
    }
}
