<?php

namespace App\Http\Controllers;

use App\Http\Requests\Projects\CreateProjectRequest;
use App\Http\Requests\Projects\UpdateProjectRequest;
use App\Models\Projects;
use App\Models\ProjectTasks;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Projects::with('creator')
            ->orderBy('created_at', 'DESC')
            ->get();

        return Inertia::render('Projects/Index', [
            'projects' => $projects
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Projects/Forms/CreateProjectForm');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProjectRequest $createProjectRequest)
    {
        $validated = $createProjectRequest->validated();
        $validated['creator_id'] = auth()->id();

        $project = Projects::create($validated);

        return Redirect::route('projects.show', $project->id)->with('success', 'Project created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Projects $project)
    {
        $project->load('creator')
            ->load('members.user');

        $todoTasks = $project->tasks()
            ->where('stage', ProjectTasks::STAGE_TODO)
            ->with('responsible')
            ->with('creator')
            ->with('taskType')
            ->get();
        $inProgressTasks = $project->tasks()
            ->where('stage', ProjectTasks::STAGE_IN_PROGRESS)
            ->with('responsible')
            ->with('creator')
            ->with('taskType')
            ->get();
        $doneTasks = $project->tasks()
            ->where('stage', ProjectTasks::STAGE_DONE)
            ->with('responsible')
            ->with('creator')
            ->with('taskType')
            ->get();

        return Inertia::render('Projects/Detail', [
            'project' => $project,
            'todoTasks' => $todoTasks,
            'inProgressTasks' => $inProgressTasks,
            'doneTasks' => $doneTasks,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Projects $project)
    {
        return Inertia::render('Projects/Forms/EditProjectForm', [
            'project' => $project
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $updateProjectRequest, Projects $project)
    {
        $validated = $updateProjectRequest->validated();

        $project->update($validated);

        return Redirect::route('projects.show', $project->id)
            ->with('success', 'Project updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Projects $project)
    {
        $project->delete();

        return Redirect::route('projects.index')
            ->with('success', 'Project deleted.');
    }
}
