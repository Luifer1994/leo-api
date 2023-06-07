<?php

use App\Http\Modules\Categories\Controllers\CategoryServiceController;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Category Routes
|--------------------------------------------------------------------------
*/

Route::prefix('categories')->group(function () {
    Route::group(['middleware' => 'jwt.verify'], function () {
        Route::prefix('services')->group(function () {
            Route::controller(CategoryServiceController::class)->group(function () {
                Route::get('list', 'all')->middleware('permission:categories-list');
            });
        });
    });
});


