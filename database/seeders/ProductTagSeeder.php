<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductTag;
use Illuminate\Database\Seeder;

class ProductTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create some product tags
        $product_tags = ProductTag::factory()->count(10)->create();

        // Create some products and assign them product tags
        Product::factory()
            ->count(10)
            ->create()
            ->each(function ($product) use ($product_tags) {
                $product->product_tags()->attach(
                    $product_tags->random(rand(1, 10))->pluck('id')->toArray()
                );
            });
    }
}
