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
            ['libelle' => "CONAKRY"],
            [
                'country_id' => 90,
                'created_by' => 1,
            ]
        );
        Town::firstOrCreate(
            ['libelle' => "COCODY (ABIDJAN)"],
            [
                'country_id' => 53,
                'created_by' => 1,
            ]
        );
        Town::firstOrCreate(
            ['libelle' => "PLATEAU (ABIDJAN)"],
            [
                'country_id' => 53,
                'created_by' => 1,
            ]
        );
        Town::firstOrCreate(
            ['libelle' => "YOPOUGON (ABIDJAN)"],
            [
                'country_id' => 53,
                'created_by' => 1,
            ]
        );
        Town::firstOrCreate(
            ['libelle' => "MARCORY (ABIDJAN)"],
            [
                'country_id' => 53,
                'created_by' => 1,
            ]
        );
        Town::firstOrCreate(
            ['libelle' => "ABOBO (ABIDJAN)"],
            [
                'country_id' => 53,
                'created_by' => 1,
            ]
        );
        Town::firstOrCreate(
            ['libelle' => "ATTECOUBE (ABIDJAN)"],
            [
                'country_id' => 53,
                'created_by' => 1,
            ]
        );
        Town::firstOrCreate(
            ['libelle' => "ADJAME (ABIDJAN)"],
            [
                'country_id' => 53,
                'created_by' => 1,
            ]
        );
        Town::firstOrCreate(
            ['libelle' => "KOUMASSI (ABIDJAN)"],
            [
                'country_id' => 53,
                'created_by' => 1,
            ]
        );
        Town::firstOrCreate(
            ['libelle' => "PORT-BOUET (ABIDJAN)"],
            [
                'country_id' => 53,
                'created_by' => 1,
            ]
        );
        Town::firstOrCreate(
            ['libelle' => "TREICHVILLE (ABIDJAN)"],
            [
                'country_id' => 53,
                'created_by' => 1,
            ]
        );
    }
}
