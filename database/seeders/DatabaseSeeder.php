<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Etudiant;
use App\Models\PersonnelAdministratif;
use App\Models\Professeur;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//         \App\Models\User::factory(2)->create();

//         \App\Models\User::factory()->create([
//             'name' => 'Test User',
//             'email' => 'test@example.com',
//             'password' => Hash::make('123'),
//         ]);
//        $admin = User::factory()->create();
//        $professeur = User::factory()->create();
//
//        PersonnelAdministratif::factory()->create([
//            'user_id' => $admin->id,
//            'role' => 1, // Administratif
//        ]);
//
//        Professeur::factory()->create([
//            'user_id' => $professeur->id,
//        ]);


        // Créez 10 étudiants
        Etudiant::factory(10)->create();

        // Créez 3 professeurs
        Professeur::factory(3)->create();

        // Creer l'admin
        PersonnelAdministratif::factory()->create([
            'user_id' => User::factory()->create([
                'nom' => "admin",
                'prenom' => "admin",
                'login' => "admin",
                'password' => Hash::make('123'), // Password: 123
            ]),
            'role' => 1, // Administratif
        ]);

//         Creer le comptable
        PersonnelAdministratif::factory()->create([
            'user_id' => User::factory()->create([
                'nom' => "comptable",
                'prenom' => "comptable",
                'login' => "comptable",
                'password' => Hash::make('123'), // Password: 123
            ]),
            'role' => 2, // comptable
        ]);
//
//        // Creer la secretaire
        PersonnelAdministratif::factory()->create([
            'user_id' => User::factory()->create([
                'nom' => "secretaire",
                'prenom' => "secretaire",
                'login' => "secretaire",
                'password' => Hash::make('123'), // Password: 123
            ]),
            'role' => 3, // Secretaire
        ]);
    }
}
