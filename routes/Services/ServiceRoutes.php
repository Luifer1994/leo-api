<?php

use App\Http\Modules\Services\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Services Routes
|--------------------------------------------------------------------------
*/

Route::prefix('services')->group(function () {
    Route::group(['middleware' => 'jwt.verify'], function () {
        Route::controller(ServiceController::class)->group(function () {
            Route::get('list', 'index')->middleware('permission:services-list');
            Route::get('show/{id}', 'show')->middleware('permission:services-show');
            Route::post('create', 'store')->middleware('permission:services-create');
            Route::put('update/{id}', 'update')->middleware('permission:services-update');
            Route::get('list-is-active', 'getAllServicesIsActive')->middleware('permission:services-list-is-active');
        });
    });
});
