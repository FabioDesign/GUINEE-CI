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
            ['libelle' => "Carte Nationale d’Identité"]
        );
        File::firstOrCreate(
            ['libelle' => "Passeport"]
        );
        File::firstOrCreate(
            ['libelle' => "Extrait d’acte de naissance"]
        );
        File::firstOrCreate(
            ['libelle' => "Acte de notoriété"]
        );
        File::firstOrCreate(
            ['libelle' => "Carte consulaire périmée"]
        );
        File::firstOrCreate(
            ['libelle' => "Carte d'électeur"]
        );
    }
}
