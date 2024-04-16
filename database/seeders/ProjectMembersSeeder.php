<?php

namespace Database\Seeders;

use App\Models\ProjectMembers;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectMembersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProjectMembers::factory(10)->create();
    }
}
