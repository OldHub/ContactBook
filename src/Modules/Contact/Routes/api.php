<?php

use Illuminate\Support\Facades\Route;
use Modules\Contact\Http\Controllers\ContactController;
use Modules\Contact\Http\Controllers\FavoriteController;

Route::group(['middleware' => ['api', 'auth:sanctum'], 'prefix' => 'v1.0'], function () {
    Route::get('contacts', [ContactController::class, 'list'])->name('contact.list');
    Route::group(['prefix' => 'contact'], function () {
        Route::post('', [ContactController::class, 'create'])->name('contact.create');
        Route::get('{contactId}', [ContactController::class, 'read'])->name('contact.read');
        Route::patch('{contactId}', [ContactController::class, 'update'])->name('contact.update');
        Route::delete('{contactId}', [ContactController::class, 'delete'])->name('contact.delete');
        Route::group(['prefix' => 'favorite'], function () {
            Route::post('{contactId}', [FavoriteController::class, 'add'])->name('contact.favorites.add');
            Route::delete('{contactId}', [FavoriteController::class, 'delete'])->name('contact.favorites.delete');
        });
    });
});
