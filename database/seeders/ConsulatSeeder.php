<?php

namespace Database\Seeders;

use App\Models\Consulat;
use Illuminate\Database\Seeder;

class ConsulatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Consulat::firstOrCreate(
            [
                'label' => "ABIDJAN",
                'country_id' => 41,
                'created_by' => 1,
            ]
        );
        Consulat::firstOrCreate(
            [
                'label' => "BOUAKE",
                'country_id' => 41,
                'created_by' => 1,
            ]
        );
    }
}
