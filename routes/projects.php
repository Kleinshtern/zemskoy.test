<?php

use App\Http\Controllers\ProjectMembersController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::resource('projects', ProjectsController::class)
    ->middleware('auth');

Route::prefix('projects/{project}')->group(function () {

    Route::prefix('members')->controller(ProjectMembersController::class)->group(function () {
        Route::post('assign', 'assignMember')->name('projects.member.assign');
        Route::delete('{member}/exclude', 'excludeMember')->name('projects.member.exclude');
        Route::patch('{member}/change-type', 'updateTypeMember')->name('projects.member.changeType');
    });

    Route::prefix('task')->controller(TaskController::class)->group(function () {
        Route::get('{task}/view', 'index')->name('projects.task.index');

        Route::prefix('{task}')->group(function () {
           Route::patch('change-title', 'updateTitle')->name('projects.task.changeTitle');
        });
    });
});
