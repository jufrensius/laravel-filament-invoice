<?php

namespace Database\Seeders;

use App\Models\CompanyTag;
use Illuminate\Database\Seeder;

class CompanyTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            "Artificial intelligence",
            "Cloud computing",
            "Cybersecurity",
            "Internet of things",
            "Robotics",
            "Software development",
            "Virtual reality",
            "E-commerce",
            "Customer service",
            "Inventory management",
            "Point of sale systems",
            "Retail analytics",
            "Supply chain management",
            "Accounting",
            "Banking",
            "Insurance",
            "Investment management",
            "Payment processing",
            "Taxation",
            "Electronic health records",
            "Medical imaging",
            "Patient care management",
            "Telemedicine",
            "Health informatics",
            "Medical devices",
            "Clean energy",
            "Oil and gas",
            "Renewable energy",
            "Smart grid",
            "Energy storage",
            "Energy efficiency",
            "Autonomous vehicles",
            "Fleet management",
            "Logistics",
            "Public transportation",
            "Ride-sharing",
            "Traffic management",
            "Accommodation",
            "Customer experience",
            "Food service",
            "Hotel management",
            "Tourism",
            "Travel booking",
            "Advertising",
            "Digital marketing",
            "Journalism",
            "Public relations",
            "Social media",
            "Video production",
            "Agriculture",
            "Food processing",
            "Food safety",
            "Restaurant management",
            "Supply chain management",
            "Wine production",
            "Automation",
            "Inventory control",
            "Lean manufacturing",
            "Quality control",
            "Supply chain management",
            "Sustainability"
        ];

        foreach ($tags as $tag) {
            CompanyTag::create([
                'name' => $tag,
            ]);
        }
    }
}
