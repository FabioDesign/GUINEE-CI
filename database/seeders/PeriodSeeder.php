<?php

namespace Database\Seeders;

use App\Models\Period;
use Illuminate\Database\Seeder;

class PeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        Period::firstOrCreate(
            ['libelle' => "Jours"]
        );
        Period::firstOrCreate(
            ['libelle' => "Semaines"]
        );
        Period::firstOrCreate(
            ['libelle' => "Mois"]
        );
        Period::firstOrCreate(
            ['libelle' => "Années"]
        );
    }
}
