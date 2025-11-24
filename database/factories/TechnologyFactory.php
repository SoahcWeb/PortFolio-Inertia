<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Technology;

class TechnologyFactory extends Factory
{
    protected $model = Technology::class;

    public function definition(): array
    {
        return [
            'name' => ucfirst($this->faker->unique()->word()),
            'color' => $this->faker->safeHexColor(),
            'order' => $this->faker->numberBetween(1, 20),
            'logo_path' => null, // Pas de fichier par défaut
        ];
    }
}
