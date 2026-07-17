<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Profile::firstOrCreate(
            ['label' => "Administrateur"],
            [
                'description' => "Administrateur du système.",
                'created_by' => 1,
                'role_id' => 1,
            ]
        );
    }
}
