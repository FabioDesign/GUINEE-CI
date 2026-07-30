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
    public function run() {
        Action::updateOrCreate(
            ['label' => "Voir"]
        );
        Action::updateOrCreate(
            ['label' => "Ajouter"]
        );
        Action::updateOrCreate(
            ['label' => "Modifier"]
        );
        Action::updateOrCreate(
            ['label' => "Supprimer"]
        );
        Action::updateOrCreate(
            ['label' => "Activer/Désactiver"]
        );
        Action::updateOrCreate(
            ['label' => "Transmettre"]
        );
        Action::updateOrCreate(
            ['label' => "Valider"]
        );
        Action::updateOrCreate(
            ['label' => "Rejeter"]
        );
        Action::updateOrCreate(
            ['label' => "Imprimer"]
        );
        Action::updateOrCreate(
            ['label' => "Récupérer"]
        );
    }
}
