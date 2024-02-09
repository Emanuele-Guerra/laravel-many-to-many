<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $array_project = config("projects");

        foreach ($array_project as $project_item) {
            //Rimuovo technology_id dai dati perchè non va scritto sulla tabella "projects"
            $technology_id = $project_item["technology_id"];
            unset($project_item["technology_id"]);
            //Creo un nuovo progetto, lo popolo, salvo
            $project = new Project();
            $project->fill($project_item);
            $project->save();
            //Collego al progetto appena salvato la tecnologia recuperata precedentemente
            $project->technologies()->attach($technology_id);
        }
    }
}
