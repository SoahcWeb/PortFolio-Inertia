<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Experience;
use App\Models\Formation;
use App\Models\PersonalInfo;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        /**
         * TECHNOLOGIES
         * On génère plusieurs technologies avec un "order" unique et croissant.
         */
        $techs = Technology::factory()
            ->count(12)
            ->sequence(fn ($sequence) => [
                'order' => $sequence->index + 1
            ])
            ->create();

        /**
         * PROJECTS
         * On génère 10 projets et on leur assigne entre 2 et 5 technologies.
         */
        Project::factory(10)->create()->each(function ($project) use ($techs) {
            $project->technologies()->attach(
                $techs->random(rand(2, 5))->pluck('id')->toArray()
            );
        });

        /**
         * EXPERIENCES & FORMATIONS
         */
        Experience::factory(5)->create();
        Formation::factory(5)->create();

        /**
         * PERSONAL INFO
         * Une seule entrée.
         */
        PersonalInfo::factory()->create();
    }
}
