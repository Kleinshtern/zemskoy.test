<?php

namespace Database\Factories;

use App\Models\Directories\TaskTypes;
use App\Models\Projects;
use App\Models\ProjectTasks;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProjectTasks>
 */
class ProjectTasksFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $project = Projects::orderByRaw('RAND()')
            ->first();

        return [
            'project_id' => $project->id,
            'title' => Str::random(10),
            'description' => Str::random(10),
            'responsible_id' => null,
            'creator_id' => $project->creator_id,
            'stage' => ProjectTasks::STAGE_TODO,
            'type_id' => TaskTypes::orderByRaw('RAND()')
                ->first()->id,
        ];
    }
}
