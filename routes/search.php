<?php

use App\Http\Controllers\Search\UserSearch;
use Illuminate\Support\Facades\Route;

Route::prefix('search')->group(function () {
    Route::prefix('user')->controller(UserSearch::class)->group(function () {
        Route::get('find_by_string', 'findBySearchString')->name('search.user.findByString');
    });
});
