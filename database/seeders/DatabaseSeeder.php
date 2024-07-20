<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $admin = User::factory()->create();
        $professeur = User::factory()->create();

        PersonnelAdministratif::factory()->create([
            'user_id' => $admin->id,
            'role' => 1, // Administratif
        ]);

        Professeur::factory()->create([
            'user_id' => $professeur->id,
        ]);
    }
}
