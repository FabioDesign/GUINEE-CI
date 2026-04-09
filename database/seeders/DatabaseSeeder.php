<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void{
        try {
            $this->call([
                // Action
                ActionSeeder::class,
                // Menu
                MenuSeeder::class,
                // Period
                PeriodSeeder::class,
                // Profil
                ProfileSeeder::class,
                // Menu-Action
                MenuActionSeeder::class,
                // Permission
                PermissionSeeder::class,
                // Utilisateur
                UserSeeder::class,
                // Ville
                TownSeeder::class,
            ]);
        } catch (QueryException $e) {
            $this->command->info("Erreur d'insertion détectée. Processus de seed ignoré pour cet enregistrement.");
        }
    }
}
