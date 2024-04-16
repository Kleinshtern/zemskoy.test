<?php

namespace Database\Seeders;

use App\Models\ProjectTasks;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectTasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProjectTasks::factory(30)->create();
    }
}
