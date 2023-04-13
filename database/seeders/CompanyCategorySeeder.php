<?php

namespace Database\Seeders;

use App\Models\CompanyCategory;
use Illuminate\Database\Seeder;

class CompanyCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Technology' => ['Hardware', 'Software', 'Internet services', 'Semiconductors', 'Telecommunications'],
            'Retail' => ['General merchandise', 'Specialty retail', 'Grocery stores', 'Online retailers', 'Convenience stores'],
            'Financial' => ['Commercial banks', 'Investment banks', 'Insurance', 'Asset management', 'Payment processors'],
            'Healthcare' => ['Pharmaceuticals', 'Medical equipment and supplies', 'Health insurance', 'Hospitals and clinics', 'Biotechnology'],
            'Energy' => ['Oil and gas exploration and production', 'Refining and marketing', 'Renewable energy', 'Utilities', 'Services and equipment'],
            'Transportation' => ['Airlines', 'Railroads', 'Trucking', 'Ride-sharing', 'Shipping'],
            'Hospitality' => ['Hotels and resorts', 'Vacation rentals', 'Online travel agencies', 'Restaurants', 'Cruise lines'],
            'Media' => ['Broadcasting', 'Cable TV', 'Film and television production', 'Print media', 'Online media'],
            'Food and beverage' => ['Non-alcoholic beverages', 'Alcoholic beverages', 'Packaged foods', 'Restaurants', 'Grocery stores'],
            'Manufacturing' => ['Automotive', 'Aerospace', 'Consumer goods', 'Industrial equipment', 'Chemicals'],
        ];

        foreach ($categories as $category => $subcategories) {
            $parentCategory = CompanyCategory::create([
                'name' => $category,
            ]);

            foreach ($subcategories as $subcategory) {
                CompanyCategory::create([
                    'name' => $subcategory,
                    'company_category_id' => $parentCategory->id,
                ]);
            }
        }
    }
}
