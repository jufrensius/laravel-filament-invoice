<?php

namespace Database\Seeders;

use App\Models\Vendor;
use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vendor::create([
            'name' => 'Laravel Filament Invoice',
            'email' => 'info@laravelfilamentinvoice.com',
            'phone_number' => '02199887766554433',
            'mobile_phone_number' => '08122334455667',
            'street' => 'Jl. Gatot Subroto No. 123',
            'state' => 'Banten',
            'city' => 'Tangerang',
            'postal_code' => '15111'
        ]);
    }
}
