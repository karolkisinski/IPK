<?php

use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\PetsController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['guest'])->get('/', [WelcomeController::class, 'show'])->name('welcome');

Route::middleware(['auth:sanctum', 'verified'])->prefix('user')->group(function() {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('pets', [PetsController::class, 'index'])->name('pets.index');
    Route::prefix('pets')->name('pets.')->group(function() {
        Route::post('', [PetsController::class, 'store'])->name('store');
        Route::delete('/delete/{pet}', [PetsController::class, 'destroy'])->name('destroy');
    });
    Route::get('profile/{user:username}', [ProfileController::class, 'show'])->name('profiles.show');
});
