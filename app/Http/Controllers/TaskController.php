<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectTasks\UpdateTaskTitleRequest;
use App\Models\Projects;
use App\Models\ProjectTasks;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TaskController extends Controller
{
    public function index(Projects $project, ProjectTasks $task)
    {
        return Inertia::render('Projects/TaskPreview', [
            'task' => $task,
            'project' => $project,
        ]);
    }

    public function updateTitle(UpdateTaskTitleRequest $updateTaskTitleRequest, Projects $project, ProjectTasks $task): JsonResponse
    {
        $validated = $updateTaskTitleRequest->validated();

        $task->title = $validated['title'];
        $task->save();

        return response()->json([
            'newTitle' => $task->title
        ]);
    }
}
