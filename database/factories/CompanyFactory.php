<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'logo' => $this->faker->imageUrl(360, 360, 'company', true, 'corporate', false, 'jpg'),
            'name' => $this->faker->company(),
            'email' => $this->faker->companyEmail(),
            'phone_number' => $this->faker->numerify('(021) ######'),
            'mobile_phone_number' => $this->faker->numerify('+62-8##-####-####'),
            'street' => $this->faker->streetAddress(),
            'state' => $this->faker->state(),
            'city' => $this->faker->city(),
            'postal_code' => $this->faker->postcode(),
        ];
    }
}
