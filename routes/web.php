<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TasksController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::get('', HomeController::class)->name('home');

    Route::prefix('tasks')->name('tasks.')->group(function () {
        Route::get('', [TasksController::class, 'index'])->name('index');
        Route::get('create', [TasksController::class, 'create'])->name('create');
        Route::post('store', [TasksController::class, 'store'])->name('store');

        Route::prefix('{task}')->group(function () {
            Route::get('edit', [TasksController::class, 'edit'])->name('edit');
            Route::patch('', [TasksController::class, 'update'])->name('update');
            Route::delete('', [TasksController::class, 'destroy'])->name('destroy');
        });
    });

    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
