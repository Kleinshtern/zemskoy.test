<?php

use App\Http\Controllers\ProjectsController;
use Illuminate\Support\Facades\Route;

Route::prefix('projects')->group(function ()
{
    Route::get('/', [ProjectsController::class, 'index'])
        ->name('projects.index');
})->middleware('auth');
