<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            ["Website Basic", 2500000, "Pembuatan website sederhana dengan 5 halaman dan template standar."],
            ["Website Pro", 5500000, "Pembuatan website profesional dengan 10 halaman dan desain custom."],
            ["Aplikasi Website Basic", 3000000, "Pembuatan aplikasi website sederhana dengan fokus pada fungsionalitas dasar dan template standar."],
            ["Aplikasi Website Pro", 7500000, "Pembuatan aplikasi website profesional dengan fokus pada fungsionalitas kompleks dan desain custom."],
            ["Aplikasi Android Basic", 4500000, "Pembuatan aplikasi Android sederhana dengan fokus pada fungsionalitas dasar dan desain sederhana."],
            ["Aplikasi Android Pro", 9500000, "Pembuatan aplikasi Android kompleks dengan fokus pada fungsionalitas canggih dan desain custom."],
            ["Aplikasi iOS Basic", 5000000, "Pembuatan aplikasi iOS sederhana dengan fokus pada fungsionalitas dasar dan desain sederhana."],
            ["Aplikasi iOS Pro", 10500000, "Pembuatan aplikasi iOS kompleks dengan fokus pada fungsionalitas canggih dan desain custom."],
            ["Aplikasi Desktop Basic", 6000000, "Pembuatan aplikasi desktop sederhana dengan fokus pada fungsionalitas dasar dan desain sederhana."],
            ["Aplikasi Desktop Pro", 12500000, "Pembuatan aplikasi desktop kompleks dengan fokus pada fungsionalitas canggih dan desain custom."],
        ];

        foreach ($products as $product) {
            Product::create([
                'name' => $product[0],
                'unit_price' => $product[1],
                'description' => $product[2],
            ]);
        }
    }
}
