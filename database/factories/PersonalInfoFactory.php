<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PersonalInfo;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PersonalInfo>
 */
class PersonalInfoFactory extends Factory
{
    protected $model = PersonalInfo::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'title' => $this->faker->jobTitle(),
            'bio' => $this->faker->paragraph(2),
            'photo' => null,
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'location' => $this->faker->city(),
            'available' => $this->faker->boolean(80),
            'cv' => null,
            'socials' => [
                'linkedin' => $this->faker->url(),
                'github' => $this->faker->url(),
                'twitter' => $this->faker->url()
            ],
        ];
    }
}
