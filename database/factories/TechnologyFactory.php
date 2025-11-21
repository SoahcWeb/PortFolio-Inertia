<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Technology;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Technology>
 */
class TechnologyFactory extends Factory
{
    protected $model = Technology::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'category' => $this->faker->randomElement(['Backend','Frontend','BDD','DevOps','Design']),
            'level' => $this->faker->randomElement(['Débutant','Intermédiaire','Avancé','Expert']),
            'logo' => null,
            'color' => '#'.$this->faker->hexcolor(),
            'order' => $this->faker->numberBetween(1,10),
        ];
    }
}
