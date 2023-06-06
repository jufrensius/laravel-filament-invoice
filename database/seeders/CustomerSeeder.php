<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Customer::factory()->count(20)->create();

        $customers = [
            ['Maria Setiawati', 'maria.setiawati@gmail.com', '', '082345678901', 'Jl. Kemang Timur No. 15B', 'Jakarta', 'Jakarta Selatan', '12730'],
            ['Budi Santoso', 'budi.santoso@yahoo.com', '0211234567', '081234567890', 'Jl. Jend. Sudirman No. 45', 'West Java', 'Bandung', '40112'],
            ['Rina Pratiwi', 'rina.pratiwi@hotmail.com', '', '085678901234', 'Jl. Siliwangi No. 20', 'West Java', 'Cimahi', '40525'],
            ['Andi Kurniawan', 'andi.kurniawan@gmail.com', '0215551234', '', 'Jl. Pangeran Antasari No. 23', 'Jakarta', 'Jakarta Selatan', '12150'],
            ['Dewi Anggraeni', 'dewi.anggraeni@gmail.com', '0312345678', '087654321098', 'Jl. Diponegoro No. 10A', 'East Java', 'Surabaya', '60241'],
            ['Ahmad Syafiq', 'ahmad.syafiq@yahoo.com', '0229876543', '081345678912', 'Jl. Ir. H. Juanda No. 70', 'West Java', 'Bandung', '40135'],
            ['Nuri Fitriyani', 'nuri.fitriyani@gmail.com', '0274561234', '082123456789', 'Jl. Sultan Agung No. 15', 'Central Java', 'Semarang', '50123'],
            ['Abdul Rahman', 'abdul.rahman@hotmail.com', '', '085712345678', 'Jl. Raya Bogor No. 12', 'West Java', 'Bogor', '16134']
        ];

        foreach ($customers as $customer) {
            Customer::create([
                'name' => $customer[0],
                'email' => $customer[1],
                'phone_number' => $customer[2],
                'mobile_phone_number' => $customer[3],
                'street' => $customer[4],
                'state' => $customer[5],
                'city' => $customer[6],
                'postal_code' => $customer[7],
            ]);
        }

        // $customerIds = Customer::all()->id;
    }
}
