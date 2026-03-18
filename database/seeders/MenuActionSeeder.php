<?php

namespace Database\Seeders;

use App\Models\MenuAction;
use Illuminate\Database\Seeder;

class MenuActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        // Tableau de bord
        MenuAction::firstOrCreate(
            [
                'menu_id' => 1,
                'action_id' => 1,
            ]
        );
        // Documents
        MenuAction::firstOrCreate(
            [
                'menu_id' => 2,
                'action_id' => 1,
            ]
        );
        MenuAction::firstOrCreate(
            [
                'menu_id' => 2,
                'action_id' => 2,
            ]
        );
        MenuAction::firstOrCreate(
            [
                'menu_id' => 2,
                'action_id' => 3,
            ]
        );
        MenuAction::firstOrCreate(
            [
                'menu_id' => 2,
                'action_id' => 4,
            ]
        );
        // Pièces à fournir
        MenuAction::firstOrCreate(
            [
                'menu_id' => 3,
                'action_id' => 1,
            ]
        );
        MenuAction::firstOrCreate(
            [
                'menu_id' => 3,
                'action_id' => 2,
            ]
        );
        MenuAction::firstOrCreate(
            [
                'menu_id' => 3,
                'action_id' => 3,
            ]
        );
        MenuAction::firstOrCreate(
            [
                'menu_id' => 3,
                'action_id' => 7,
            ]
        );
        // Paramètres
        MenuAction::firstOrCreate(
            [
                'menu_id' => 4,
                'action_id' => 1,
            ]
        );
        MenuAction::firstOrCreate(
            [
                'menu_id' => 4,
                'action_id' => 2,
            ]
        );
        MenuAction::firstOrCreate(
            [
                'menu_id' => 4,
                'action_id' => 3,
            ]
        );
        // Gestion des Profils
        MenuAction::firstOrCreate(
            [
                'menu_id' => 5,
                'action_id' => 1,
            ]
        );
        MenuAction::firstOrCreate(
            [
                'menu_id' => 5,
                'action_id' => 2,
            ]
        );
        MenuAction::firstOrCreate(
            [
                'menu_id' => 5,
                'action_id' => 3,
            ]
        );
        MenuAction::firstOrCreate(
            [
                'menu_id' => 5,
                'action_id' => 4,
            ]
        );
        MenuAction::firstOrCreate(
            [
                'menu_id' => 5,
                'action_id' => 7,
            ]
        );
        // Gestion des Utilisateurs
        MenuAction::firstOrCreate(
            [
                'menu_id' => 6,
                'action_id' => 1,
            ]
        );
        MenuAction::firstOrCreate(
            [
                'menu_id' => 6,
                'action_id' => 2,
            ]
        );
        MenuAction::firstOrCreate(
            [
                'menu_id' => 6,
                'action_id' => 3,
            ]
        );
        MenuAction::firstOrCreate(
            [
                'menu_id' => 6,
                'action_id' => 4,
            ]
        );
        // Demandes
        MenuAction::firstOrCreate(
            [
                'menu_id' => 7,
                'action_id' => 1,
            ]
        );
        MenuAction::firstOrCreate(
            [
                'menu_id' => 7,
                'action_id' => 2,
            ]
        );
        MenuAction::firstOrCreate(
            [
                'menu_id' => 7,
                'action_id' => 3,
            ]
        );
        MenuAction::firstOrCreate(
            [
                'menu_id' => 7,
                'action_id' => 5,
            ]
        );
        MenuAction::firstOrCreate(
            [
                'menu_id' => 7,
                'action_id' => 6,
            ]
        );
        MenuAction::firstOrCreate(
            [
                'menu_id' => 7,
                'action_id' => 7,
            ]
        );
        // Piste d'audit
        MenuAction::firstOrCreate(
            [
                'menu_id' => 8,
                'action_id' => 1,
            ]
        );
    }
}
