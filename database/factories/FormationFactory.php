<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Formation;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Formation>
 */
class FormationFactory extends Factory
{
    protected $model = Formation::class;

    public function definition(): array
    {
        $start = $this->faker->dateTimeBetween('-5 years','now');
        $end = $this->faker->dateTimeBetween($start,'now');

        return [
            'degree' => $this->faker->sentence(3),
            'school' => $this->faker->company(),
            'location' => $this->faker->city(),
            'start_date' => $start->format('Y-m-d'),
            'end_date' => $end->format('Y-m-d'),
            'description' => $this->faker->paragraph(),
        ];
    }
}
