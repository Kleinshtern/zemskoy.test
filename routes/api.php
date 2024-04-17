<?php

use App\Http\Controllers\API\ProjectApiController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::prefix('api')->group(function () {

        Route::prefix('projects')->controller(ProjectApiController::class)->group(function () {
            Route::get('load-types-member', 'loadTypesMember')->name('api.projects.loadTypesMember');
        });
    });
});
