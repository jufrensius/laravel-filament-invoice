<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'email' => $this->faker->companyEmail(),
            'phone_number' => $this->faker->numerify('(021) ######'),
            'mobile_phone_number' => $this->faker->numerify('+62-8##-####-####'),
            'street' => $this->faker->optional()->streetAddress(),
            'state' => $this->faker->optional()->state(),
            'city' => $this->faker->optional()->city(),
            'postal_code' => $this->faker->optional()->postcode(),
        ];
    }
}
