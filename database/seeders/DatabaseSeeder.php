<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Etudiant;
use App\Models\Filiere;
use App\Models\Module;
use App\Models\PersonnelAdministratif;
use App\Models\Professeur;
use App\Models\Role;
use App\Models\User;
use Database\Factories\FiliereFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Créez une filière : Genie logiciel
        $gl = Filiere::factory()->create([
            'nom_filiere' => 'Génie logiciel',
            'description' => 'Cette filière recherche les étudiants en informatique.',
            'montant_formation' => 1000000,
        ]);

        // Créez une filière : Miage
        $miage = Filiere::factory()->create([
            'nom_filiere' => 'MIAGE',
            'description' => 'Maitriser l\'informatique de gestion.',
            'montant_formation' => 800000,
        ]);

        // Créez une filière : ISR
        $isr = Filiere::factory()->create([
            'nom_filiere' => 'ISR',
            'description' => 'Apprendre le reseau informatique en profondeur',
            'montant_formation' => 900000,
        ]);

        // Créez 5 étudiants dans la filiere gl
        $etudiants_gl = Etudiant::factory(5)->create(['filiere_id' => $gl->id,]);

        // Créez 5 étudiants dans la filiere miage
        $etudiants_miage = Etudiant::factory(5)->create(['filiere_id' => $miage->id,]);

        // Créez 5 étudiants dans la filiere ISR
        $etudiants_isr = Etudiant::factory(5)->create(['filiere_id' => $isr->id,]);

        //Creer 6 module
        $algo = Module::factory()->create([
            'nom_module' => "Algorithmique",
            'description' => "Module de programmation",
        ]);
        $bd = Module::factory()->create([
            'nom_module' => "Base de données",
            'description' => "Module de base de données",
        ]);
        $si = Module::factory()->create([
            'nom_module' => "Système d'information",
            'description' => "Module de Système d'information",
        ]);
        $po = Module::factory()->create([
            'nom_module' => "Programmation orientée objet",
            'description' => "Module de programmation orientée objet",
        ]);
        $web = Module::factory()->create([
            'nom_module' => "Programmation web",
            'description' => "Module de programmation web",
        ]);
        $cyber = Module::factory()->create([
            'nom_module' => "Introduction a la cybersecurity",
            'description' => "Module de de cybersecurity",
        ]);

        //Associer les filieres a deux modules chacune
        $gl->modules()->sync([$algo->id, $po->id, $cyber->id]);

        $miage->modules()->sync([$bd->id, $web->id]);

        $isr->modules()->sync([$si->id, $cyber->id]);

        // Créez 3 professeurs
        $moh = Professeur::factory()->create([
            'user_id' => User::factory()->create([
                'nom' => "Konate",
                'prenom' => "Mohamed",
                'login' => "prof.java",
                'password' => Hash::make('123'), // Password: 123
            ]),
            'specialites' => json_encode(["Java", "PHP"]),
        ]);

        $allassane = Professeur::factory()->create([
            'user_id' => User::factory()->create([
                'nom' => "Traore",
                'prenom' => "Allassane",
                'login' => "prof.html",
                'password' => Hash::make('123'), // Password: 123
            ]),
            'specialites' => json_encode(["HTML", "PHP"]),
        ]);

        $yaya = Professeur::factory()->create([
            'user_id' => User::factory()->create([
                'nom' => "Goita",
                'prenom' => "Yaya",
                'login' => "prof.pyton",
                'password' => Hash::make('123'), // Password: 123
            ]),
            'specialites' => json_encode(["Java", "Python"]),
        ]);
        //Associer les prof au module
        $algo->professeurs()->sync([$yaya->id, $moh->id]);
        $po->professeurs()->sync([$allassane->id, $moh->id, $yaya->id]);
        $cyber->professeurs()->sync([$allassane->id, $moh->id, $yaya->id]);
        $bd->professeurs()->sync([$yaya->id, $moh->id, $yaya->id]);
        $web->professeurs()->sync([$allassane->id, $moh->id, $yaya->id]);
        $si->professeurs()->sync([$yaya->id, $moh->id, $yaya->id]);


        // Ajoutez une note d'examen et note de classe aux etudiants
        foreach ($etudiants_gl as $etudiant) {
            foreach ($gl->modules as $module) {
                $etudiant->modules()->attach($module->id, ['note_examen' => rand(0, 20), 'note_classe' => rand(0, 20)]);
            }
        }
        foreach ($etudiants_miage as $etudiant) {
            foreach ($miage->modules as $module) {
                $etudiant->modules()->attach($module->id, ['note_examen' => rand(0, 20), 'note_classe' => rand(0, 20)]);
            }
        }
        foreach ($etudiants_isr as $etudiant) {
            foreach ($isr->modules as $module) {
                $etudiant->modules()->attach($module->id, ['note_examen' => rand(0, 20), 'note_classe' => rand(0, 20)]);
            }
        }


        //Creer les differents roles
        $admin = Role::factory()->create(['nom' => "Administrateur"]);
        $comptable = Role::factory()->create(['nom' => "Comptable"]);
        $secretaire = Role::factory()->create(['nom' => "Secrétaire"]);

        // Creer l'admin
        PersonnelAdministratif::factory()->create([
            'user_id' => User::factory()->create([
                'nom' => "admin",
                'prenom' => "admin",
                'login' => "admin",
                'password' => Hash::make('123'), // Password: 123
            ]),
            'role_id' => $admin->id, // Administratif
        ]);

//         Creer le comptable
        PersonnelAdministratif::factory()->create([
            'user_id' => User::factory()->create([
                'nom' => "comptable",
                'prenom' => "comptable",
                'login' => "comptable",
                'password' => Hash::make('123'), // Password: 123
            ]),
            'role_id' => $comptable->id, // comptable
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
            'role_id' => $secretaire->id, // Secretaire
        ]);
    }
}
