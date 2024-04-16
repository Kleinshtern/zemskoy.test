<?php

namespace Database\Factories;

use App\Models\ProjectMembers;
use App\Models\Projects;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProjectMembers>
 */
class ProjectMembersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'project_id' => Projects::orderByRaw('RAND()')->first()->id,
            'user_id' => User::orderByRaw('RAND()')->first()->id,
            'member_type' => ProjectMembers::TYPE_EXECUTOR
        ];
    }
}
