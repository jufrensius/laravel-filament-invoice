<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use HasFactory;
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        return $this->call([
            PermissionSeeder::class,
            StatusSeeder::class,
            PaymentMethodSeeder::class,
            VendorSeeder::class,
            CustomerCategorySeeder::class,
            CustomerSeeder::class,
            ProductSeeder::class,
            // CompanyCategorySeeder::class,
            // CompanyTagSeeder::class,
            // CompanySeeder::class,
            // CustomerSeeder::class,
            // ProductTagSeeder::class,
        ]);
    }
}
