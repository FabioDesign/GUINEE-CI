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
    public function run(){
        Profile::firstOrCreate(
            ['libelle' => "Administrateur"],
            [
                'description' => "Administrateur du système.",
                'created_by' => 1,
            ]
        );
        Profile::firstOrCreate(
            ['libelle' => "Consul"],
            [
                'description' => "Gestionnaire du système.",
                'created_by' => 1,
            ]
        );
    }
}
