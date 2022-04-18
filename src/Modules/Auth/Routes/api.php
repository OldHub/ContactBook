<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\AuthController;

Route::group(['prefix' => 'v1.0'], function () {
    Route::group(['prefix' => 'auth', 'middleware' => 'api'], function () {
        Route::post('registration', [AuthController::class, 'registration'])->name('auth.registration');
        Route::post('login', [AuthController::class, 'login'])->name('auth.login');
        Route::post('forgot', [AuthController::class, 'forgot'])->name('auth.forgot');
        Route::get('password', [AuthController::class, 'checkPassword'])->name('auth.password.check');
        Route::post('password', [AuthController::class, 'resetPassword'])->name('auth.password.reset');

        Route::group(['middleware' => 'auth:sanctum'], function () {
            Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');
        });
    });
});
