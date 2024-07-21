<?php

namespace Database\Factories;

use App\Models\Filiere;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Etudiant>
 */
class EtudiantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'id' => $this->faker->uuid,
            'user_id' => User::factory(),
            'filiere_id' => Filiere::factory(),
            'etat_paiement' => $this->faker->randomFloat(2, 0, 1000000),
        ];
    }
}
