<?php

use App\Http\Controllers\ProjectMembersController;
use App\Http\Controllers\ProjectsController;
use Illuminate\Support\Facades\Route;

Route::resource('projects', ProjectsController::class)
    ->middleware('auth');

Route::prefix('members')->controller(ProjectMembersController::class)->group(function () {
    Route::post('{user}/assign', 'assignMember')->name('projects.member.assign');
    Route::delete('{member}/exclude', 'excludeMember')->name('projects.member.exclude');
    Route::patch('{member}/change-type', 'updateTypeMember')->name('projects.member.changeType');
});
