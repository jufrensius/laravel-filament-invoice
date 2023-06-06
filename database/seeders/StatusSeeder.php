<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Status::factory()->count(3)->create();
        $invoiceStatuses = [
            ['Draft', 'Invoice has been created but not sent', '#ffc107'],
            ['Pending', 'Invoice has been sent but not paid', '#2196f3'],
            ['Overdue', 'Payment is late', '#f44336'],
            ['Paid', 'Invoice has been paid in full', '#4caf50'],
            ['Partially Paid', 'Invoice has been partially paid', '#8bc34a'],
            ['Void', 'Invoice has been cancelled', '#9e9e9e'],
            ['Refunded', 'Customer has been refunded', '#9c27b0'],
        ];

        foreach ($invoiceStatuses as $invoiceStatus) {
            Status::create([
                'name' => $invoiceStatus[0],
                'description' => $invoiceStatus[1],
                'color' => $invoiceStatus[2],
            ]);
        }
    }
}
