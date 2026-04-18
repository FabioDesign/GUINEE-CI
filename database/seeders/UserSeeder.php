<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['whatsapp' => '2250102030405'],
            [
                'title' => 'M.',
                'lastname' => 'OGOU',
                'firstname' => 'Fabrice',
                'gender' => 'M',
                'number' => '',
                'email' => 'fabio225@yopmail.com',
                'password' => Hash::make('Azerty@123'),
                'password_at' => now(),
                'birthday_at' => '1990-05-15',
                'birthplace' => 'Cocody',
                'size' => '1.75',
                'hair' => 'Brun',
                'complexion' => 'Clair',
                'profession' => 'Ingénieur',
                'father_fullname' => 'Léon OGOU',
                'mother_fullname' => 'Apo KOUASSI',
                'person_fullname' => 'JB OGOU',
                'person_number' => '2250102030406',
                'person_address' => '10 rue de Cocody, 75001 Abidjan',
                'arrival_at' => '2000-05-00',
                'status' => 1,
                'activated_at' => now(),
                'created_by' => 1,
                'activated_by' => 1,
                'town_id' => 2,
                'profile_id' => 1,
                'country_id' => 53,
                'nationality_id' => 49,
            ]
        );
    }
}