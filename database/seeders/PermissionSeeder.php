<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Artisan::call('permissions:sync');

        $adminPersmissions = Permission::all();

        $adminRole = Role::create([
            'name' => 'admin',
        ]);

        foreach ($adminPersmissions as $adminPersmission) {
            $adminRole->givePermissionTo($adminPersmission);
        }

        $admins = [
            ['Jufrensis Antony Barasa', 'jufrensiusbarasa@gmail.com', Carbon::now(), 'jufrensiusbarasa@gmail.com', Str::random()],
            ['Kezia Zsazsa Maharani Sasongko Putri', 'keziazsa@gmail.com', Carbon::now(), 'keziazsa@gmail.com', Str::random()],
        ];

        foreach ($admins as $admin) {
            $admin = User::create([
                'name' => $admin[0],
                'email' => $admin[1],
                'email_verified_at' => $admin[2],
                'password' => $admin[3],
                'remember_token' => $admin[4],
            ]);

            $admin->assignRole('admin');
        }
    }
}
