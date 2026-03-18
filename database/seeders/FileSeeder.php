<?php

namespace Database\Seeders;

use App\Models\File;
use Illuminate\Database\Seeder;

class FileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        File::firstOrCreate(
            ['en' => "National Identity Card"],
            [
                'fr' => "Carte Nationale d’Identité",
                'status' => 1,
            ]
        );
        File::firstOrCreate(
            ['en' => "Passport"],
            [
                'fr' => "Passeport",
                'status' => 1,
            ]
        );
        File::firstOrCreate(
            ['en' => "Extract from birth certificate"],
            [
                'fr' => "Extrait d’acte de naissance",
                'status' => 1,
            ]
        );
        File::firstOrCreate(
            ['en' => "Notoriety act"],
            [
                'fr' => "Acte de notoriété",
                'status' => 1,
            ]
        );
        File::firstOrCreate(
            ['en' => "Consular card expired"],
            [
                'fr' => "Carte consulaire périmée",
                'status' => 1,
            ]
        );
        File::firstOrCreate(
            ['en' => "Electoral card"],
            [
                'fr' => "Carte d'électeur",
                'status' => 1,
            ]
        );
    }
}
