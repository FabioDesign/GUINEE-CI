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
        // Action 1
        Action::updateOrCreate(
            ['label' => "Voir"],
            ['position' => 1]
        );
        // Action 2
        Action::updateOrCreate(
            ['label' => "Ajouter"],
            ['position' => 2]
        );
        // Action 3
        Action::updateOrCreate(
            ['label' => "Modifier"],
            ['position' => 3]
        );
        // Action 4
        Action::updateOrCreate(
            ['label' => "Activer/Désactiver"],
            ['position' => 5]
        );
        // Action 5
        Action::updateOrCreate(
            ['label' => "Supprimer"],
            ['position' => 6]
        );
        // Action 6
        Action::updateOrCreate(
            ['label' => "Transmettre"],
            ['position' => 7]
        );
        // Action 7
        Action::updateOrCreate(
            ['label' => "Valider"],
            ['position' => 8]
        );
        // Action 8
        Action::updateOrCreate(
            ['label' => "Rejeter"],
            ['position' => 9]
        );
        // Action 9
        Action::updateOrCreate(
            ['label' => "Imprimer A4"],
            ['position' => 11]
        );
        // Action 10
        Action::updateOrCreate(
            ['label' => "Récupérer"],
            ['position' => 10]
        );
        // Action 11
        Action::updateOrCreate(
            ['label' => "Imprimer A5"],
            ['position' => 12]
        );
        // Action 12
        Action::updateOrCreate(
            ['label' => "Dupliquer"],
            ['position' => 4]
        );
    }
}
