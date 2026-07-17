<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Role::firstOrCreate(
            ['label' => "Admin"]
        );
        Role::firstOrCreate(
            ['label' => "Consul"]
        );
        Role::firstOrCreate(
            ['label' => "Agent"]
        );
        Role::firstOrCreate(
            ['label' => "User"]
        );
    }
}
