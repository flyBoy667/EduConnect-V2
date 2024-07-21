<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Filiere>
 */
class FiliereFactory extends Factory
{
    protected static $noms = [
        'Génie logiciel',
        'MIAGE',
        'ISR',
        'Marketing',
        'Gestion',
        'Finance',
        'Informatique',
        'Sciences',
        'Droit',
        'Médecine',
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nom_filiere = $this->faker->unique()->randomElement(self::$noms);
        return [
            'id' => $this->faker->uuid,
            'nom_filiere' => $nom_filiere,
            'description' => $this->faker->sentence,
            'montant_formation' => $this->faker->randomFloat(2, 1000, 10000),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
