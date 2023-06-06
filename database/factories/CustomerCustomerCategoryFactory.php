<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\CustomerCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerCustomerCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'customer_id' => Customer::all()->random()->id,
            'customer_category_id' => CustomerCategory::all()->random()->id,
        ];
    }
}
