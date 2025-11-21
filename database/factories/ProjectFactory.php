<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Project;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        $title = $this->faker->sentence(3);
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'short_description' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(3),
            'type' => $this->faker->randomElement(['Site web','App mobile','API','Design']),
            'status' => $this->faker->randomElement(['draft','published','archived']),
            'date' => $this->faker->date(),
            'client' => $this->faker->company(),
            'context' => $this->faker->randomElement(['Scolaire','Stage','Freelance','Personnel']),
            'role' => $this->faker->jobTitle(),
            'link' => $this->faker->url(),
            'github' => $this->faker->url(),
            'order' => $this->faker->numberBetween(1,10),
            'main_image' => null,
        ];
    }
}
