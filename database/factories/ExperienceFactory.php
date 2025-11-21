<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Experience;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Experience>
 */
class ExperienceFactory extends Factory
{
    protected $model = Experience::class;

    public function definition(): array
    {
        $start = $this->faker->dateTimeBetween('-5 years','now');
        $end = $this->faker->dateTimeBetween($start,'now');

        return [
            'position' => $this->faker->jobTitle(),
            'company' => $this->faker->company(),
            'location' => $this->faker->city(),
            'start_date' => $start->format('Y-m-d'),
            'end_date' => $end->format('Y-m-d'),
            'description' => $this->faker->paragraph(),
            'type' => $this->faker->randomElement(['Stage','CDI','CDD','Freelance','Alternance']),
        ];
    }
}
