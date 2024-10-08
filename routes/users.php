<?php

use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::prefix('users')->group(function () {
    Route::get('', [UsersController::class, 'index'])
        ->name('users.index');
})->middleware('auth');
