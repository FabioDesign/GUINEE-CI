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
            ['number' => '2250102030405'],
            [
                'lastname' => 'OGOU',
                'firstname' => 'Fabrice',
                'gender' => 'M',
                'email' => 'fabio225@yopmail.com',
                'password' => Hash::make('Azerty@123'),
                'password_at' => now(),
                'birthday_at' => '1990-05-15',
                'birthplace' => 'Cocody',
                'size' => '175',
                'hair' => 'Brun',
                'complexion' => 'Clair',
                'profession' => 'Ingénieur',
                'father_fullname' => 'Léon OGOU',
                'mother_fullname' => 'Apo KOUASSI',
                'person_fullname' => 'JB OGOU',
                'person_number' => '2250102030406',
                'person_address' => '10 rue de Cocody, 75001 Abidjan',
                'month' => 'Mai',
                'year' => 2000,
                'status' => 1,
                'activated_at' => now(),
                'town_id' => 1,
                'activated_id' => 1,
                'profile_id' => 1,
            ]
        );
    }
}