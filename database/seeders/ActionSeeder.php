<?php

namespace Database\Seeders;

use App\Models\Action;
use Illuminate\Database\Seeder;

class ActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        Action::firstOrCreate(
            ['label' => "Voir"]
        );
        Action::firstOrCreate(
            ['label' => "Ajouter"]
        );
        Action::firstOrCreate(
            ['label' => "Modifier"]
        );
        Action::firstOrCreate(
            ['label' => "Supprimer"]
        );
        Action::firstOrCreate(
            ['label' => "Activer/Désactiver"]
        );
        Action::firstOrCreate(
            ['label' => "Transmettre"]
        );
        Action::firstOrCreate(
            ['label' => "Valider"]
        );
        Action::firstOrCreate(
            ['label' => "Rejeter"]
        );
        Action::firstOrCreate(
            ['label' => "Imprimer"]
        );
    }
}
