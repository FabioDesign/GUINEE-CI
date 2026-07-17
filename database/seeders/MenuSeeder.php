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
    public function run() {
        Menu::firstOrCreate(
            ['label' => "Tableau de bord"],
            [
                'icone' => "ki-element-7",
                'target' => "dashboard",
                'position' => 1,
            ]
        );
        Menu::firstOrCreate(
            ['label' => "Demandes"],
            [
                'icone' => "ki-calendar-8",
                'target' => "demands",
                'position' => 2,
            ]
        );
        Menu::firstOrCreate(
            ['label' => "Documents"],
            [
                'icone' => "ki-abstract-26",
                'target' => "documents",
                'position' => 3,
            ]
        );
        Menu::firstOrCreate(
            ['label' => "Pièces à fournir"],
            [
                'icone' => "ki-abstract-25",
                'target' => "files",
                'position' => 4,
            ]
        );
        Menu::firstOrCreate(
            ['label' => "Villes"],
            [
                'icone' => "ki-bank",
                'target' => "towns",
                'position' => 5,
            ]
        );
        Menu::firstOrCreate(
            ['label' => "Agences"],
            [
                'icone' => "ki-call",
                'target' => "agencies",
                'position' => 6,
            ]
        );
        Menu::firstOrCreate(
            ['label' => "Profils"],
            [
                'icone' => "ki-map",
                'target' => "profiles",
                'position' => 7,
            ]
        );
        Menu::firstOrCreate(
            ['label' => "Utilisateurs"],
            [
                'icone' => "ki-address-book",
                'target' => "users",
                'position' => 8,
            ]
        );
        Menu::firstOrCreate(
            ['label' => "Piste d'audit"],
            [
                'icone' => "ki-code",
                'target' => "logs",
                'position' => 9,
            ]
        );
    }
}
