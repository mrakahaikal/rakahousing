<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::create([
            'name' => 'admin'
        ]);

        $lenderRole = Role::create([
            'name' => 'lender'
        ]);

        $agentRole = Role::create([
            'name' => 'agent'
        ]);

        $customerRole = Role::create([
            'name' => 'customer'
        ]);

        $user = User::create([
            'name' => 'Yushi Selpia',
            'email' => 'yh.slp@rakahousing.com',
            'phone' => '081222646533',
            'photo' => 'avatar/ipi.png',
            'password' => bcrypt('yh.slp123'),
        ]);

        $user->assignRole($adminRole);
    }
}
