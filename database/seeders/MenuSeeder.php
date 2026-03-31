<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        Menu::firstOrCreate(
            ['libelle' => "Tableau de bord"],
            [
                'icone' => "dashboard-icon",
                'target' => "/dashboard",
                'position' => 1,
            ]
        );
        Menu::firstOrCreate(
            ['libelle' => "Demandes"],
            [
                'icone' => "requests-icon",
                'target' => "/requests",
                'position' => 2,
            ]
        );
        Menu::firstOrCreate(
            ['libelle' => "Documents"],
            [
                'icone' => "documents-icon",
                'target' => "/documents",
                'position' => 3,
            ]
        );
        Menu::firstOrCreate(
            ['libelle' => "Pièces à fournir"],
            [
                'icone' => "files-icon",
                'target' => "/files",
                'position' => 4,
            ]
        );
        Menu::firstOrCreate(
            ['libelle' => "Villes"],
            [
                'icone' => "cities-icon",
                'target' => "/cities",
                'position' => 5,
            ]
        );
        Menu::firstOrCreate(
            ['libelle' => "Gestion des Menus"],
            [
                'icone' => "menus-icon",
                'target' => "/menus",
                'position' => 6,
            ]
        );
        Menu::firstOrCreate(
            ['libelle' => "Gestion des Profils"],
            [
                'icone' => "profile-icon",
                'target' => "/profile",
                'position' => 7,
            ]
        );
        Menu::firstOrCreate(
            ['libelle' => "Gestion des Utilisateurs"],
            [
                'icone' => "user-icon",
                'target' => "/users",
                'position' => 8,
            ]
        );
        Menu::firstOrCreate(
            ['libelle' => "Piste d'audit"],
            [
                'icone' => "audit_trail-icon",
                'target' => "/audit_trail",
                'position' => 9,
            ]
        );
    }
}
