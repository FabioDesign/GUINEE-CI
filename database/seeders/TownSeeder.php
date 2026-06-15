<?php

namespace Database\Seeders;

use App\Models\Town;
use Illuminate\Database\Seeder;

class TownSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Town::firstOrCreate(
            ['label' => "CONAKRY"],
            [
                'country_id' => 61,
                'created_by' => 1,
            ]
        );
        Town::firstOrCreate(
            ['label' => "COCODY (ABIDJAN)"],
            [
                'country_id' => 41,
                'created_by' => 1,
            ]
        );
        Town::firstOrCreate(
            ['label' => "PLATEAU (ABIDJAN)"],
            [
                'country_id' => 41,
                'created_by' => 1,
            ]
        );
        Town::firstOrCreate(
            ['label' => "YOPOUGON (ABIDJAN)"],
            [
                'country_id' => 41,
                'created_by' => 1,
            ]
        );
        Town::firstOrCreate(
            ['label' => "MARCORY (ABIDJAN)"],
            [
                'country_id' => 41,
                'created_by' => 1,
            ]
        );
        Town::firstOrCreate(
            ['label' => "ABOBO (ABIDJAN)"],
            [
                'country_id' => 41,
                'created_by' => 1,
            ]
        );
        Town::firstOrCreate(
            ['label' => "ATTECOUBE (ABIDJAN)"],
            [
                'country_id' => 41,
                'created_by' => 1,
            ]
        );
        Town::firstOrCreate(
            ['label' => "ADJAME (ABIDJAN)"],
            [
                'country_id' => 41,
                'created_by' => 1,
            ]
        );
        Town::firstOrCreate(
            ['label' => "KOUMASSI (ABIDJAN)"],
            [
                'country_id' => 41,
                'created_by' => 1,
            ]
        );
        Town::firstOrCreate(
            ['label' => "PORT-BOUET (ABIDJAN)"],
            [
                'country_id' => 41,
                'created_by' => 1,
            ]
        );
        Town::firstOrCreate(
            ['label' => "TREICHVILLE (ABIDJAN)"],
            [
                'country_id' => 41,
                'created_by' => 1,
            ]
        );
    }
}
