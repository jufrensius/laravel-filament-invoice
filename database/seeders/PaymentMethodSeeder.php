<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paymentMethods = [
            [
                'https://www.bankmandiri.co.id/assets/images/logo-mandiri.png',
                'Bank Mandiri',
                'PT. Laravel Filament Invoice',
                '1234567890',
                '**Payment Steps:**
                1. Go to the nearest ATM or transfer via mobile banking
                2. Select transfer menu and choose Mandiri account
                3. Input the account number and transfer amount
                4. Confirm the transaction'
            ],
            [
                'https://www.bca.co.id/themes/custom/bca/logo.svg',
                'Bank Central Asia (BCA)',
                'PT. Laravel Filament Invoice',
                '2345678901',
                '**Payment Steps:**
                1. Go to the nearest ATM or transfer via mobile banking
                2. Select transfer menu and choose BCA account
                3. Input the account number and transfer amount
                4. Confirm the transaction'
            ],
            [
                'https://www.bni.co.id/Portals/_default/Skins/BNII/images/bni-logo.png',
                'Bank Negara Indonesia (BNI)',
                'PT. Laravel Filament Invoice',
                '3456789012',
                '**Payment Steps:**
                1. Go to the nearest ATM or transfer via mobile banking
                2. Select transfer menu and choose BNI account
                3. Input the account number and transfer amount
                4. Confirm the transaction'
            ],
        ];


        foreach ($paymentMethods as $paymentMethod) {
            PaymentMethod::create([
                'logo' => $paymentMethod[0],
                'bank_name' => $paymentMethod[1],
                'account_name' => $paymentMethod[2],
                'account_number' => $paymentMethod[3],
                'description' => $paymentMethod[4],
            ]);
        }
    }
}
