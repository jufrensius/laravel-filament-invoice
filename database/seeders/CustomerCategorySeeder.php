<?php

namespace Database\Seeders;

use App\Models\CustomerCategory;
use Illuminate\Database\Seeder;

class CustomerCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customerCategories = [
            ["Regular", "regular", NULL],
            ["VIP", "vip", NULL],
            ["Gold", "gold", 2],
            ["Platinum", "platinum", 2],
            ["Silver", "silver", 1],
            ["Bronze", "bronze", 1]
        ];

        foreach ($customerCategories as $customerCategory) {
            CustomerCategory::create([
                'name' => $customerCategory[0],
                'slug' => $customerCategory[1],
                'customer_category_id' => $customerCategory[2],
            ]);
        }
    }
}
