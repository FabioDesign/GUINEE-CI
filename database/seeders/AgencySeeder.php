<?php

namespace Database\Seeders;

use App\Models\Agency;
use Illuminate\Database\Seeder;

class AgencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Agency::firstOrCreate(
            [
                'label' => "ABIDJAN",
                'country_id' => 41,
                'created_by' => 1,
            ]
        );
        Agency::firstOrCreate(
            [
                'label' => "BOUAKE",
                'country_id' => 41,
                'created_by' => 1,
            ]
        );
    }
}
