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
        // Créer quelques technologies
        $techs = Technology::factory(5)->create();

        // Créer des projets et les relier aux technologies
        Project::factory(10)->create()->each(function($project) use ($techs) {
            $project->technologies()->attach(
                $techs->random(rand(1,3))->pluck('id')->toArray()
            );
        });

        // Créer expériences et formations
        Experience::factory(5)->create();
        Formation::factory(5)->create();

        // Créer les infos personnelles
        PersonalInfo::factory(1)->create();
    }
}
