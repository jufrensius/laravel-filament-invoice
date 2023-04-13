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
            ['https://www.bankmandiri.co.id/assets/images/logo-mandiri.png', 'Bank Mandiri', 'PT. Laravel Filament Invoice', '1234567890', 'Transfer melalui ATM atau mobile banking'],
            ['https://www.bca.co.id/themes/custom/bca/logo.svg', 'Bank Central Asia (BCA)', 'PT. Laravel Filament Invoice', '2345678901', 'Transfer melalui ATM, mobile banking atau internet banking'],
            ['https://www.bni.co.id/Portals/_default/Skins/BNII/images/bni-logo.png', 'Bank Negara Indonesia (BNI)', 'PT. Laravel Filament Invoice', '3456789012', 'Transfer melalui ATM atau mobile banking'],
            ['https://www.cimbniaga.co.id/assets/optimized/images/cimb-niaga-logo-08-2021.png', 'CIMB Niaga', 'PT. Laravel Filament Invoice', '4567890123', 'Transfer melalui ATM, mobile banking atau internet banking'],
            ['https://www.bankmega.com/themes/sitev2/images/bankmega-logo.png', 'Bank Mega', 'PT. Laravel Filament Invoice', '5678901234', 'Transfer melalui ATM atau mobile banking'],
            ['https://www.bankdanamon.co.id/Assets/Danamon/Static/img/logo-danamon.png', 'Bank Danamon', 'PT. Laravel Filament Invoice', '6789012345', 'Transfer melalui ATM, mobile banking atau internet banking'],
            ['https://www.bankbtpn.com/Sites/BTPN/Style%20Library/BTPN/Assets/Images/BTPN-Logo.svg', 'Bank BTPN', 'PT. Laravel Filament Invoice', '7890123456', 'Transfer melalui ATM atau mobile banking'],
            ['https://www.bri.co.id/wss/img/logo-bri.png', 'Bank Rakyat Indonesia (BRI)', 'PT. Laravel Filament Invoice', '8901234567', 'Transfer melalui ATM atau mobile banking'],
            ['https://www.bukopin.co.id/images/bankbukopin.png', 'Bank Bukopin', 'PT. Laravel Filament Invoice', '9012345678', 'Transfer melalui ATM atau mobile banking'],
            ['https://www.bii.co.id/images/logo-bii.png', 'Bank Internasional Indonesia (BII)', 'PT. Laravel Filament Invoice', '0123456789', 'Transfer melalui ATM, mobile banking atau internet banking']
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
