<?php

namespace Database\Seeders;

use App\Models\MaritalStatus;
use Illuminate\Database\Seeder;

class MaritalStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        MaritalStatus::firstOrCreate(
            ["label" => 'Célibataire']
        );
        MaritalStatus::firstOrCreate(
            ["label" => 'Marié(e)']
        );
        MaritalStatus::firstOrCreate(
            ["label" => 'Divorcé(e)']
        );
        MaritalStatus::firstOrCreate(
            ["label" => 'Veuf/Veuve']
        );
    }
}
