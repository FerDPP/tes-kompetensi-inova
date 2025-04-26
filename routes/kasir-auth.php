<?php

use App\Http\Controllers\Kasir\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Kasir\Auth\RegisteredUserController;
use App\Http\Controllers\Kasir\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:kasir')->prefix('kasir')->name('kasir.')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth:kasir')->prefix('kasir')->name('kasir.')->group(function () {
    
    Route::get('/dashboard', function () {
        return view('kasir.dashboard');
    })->middleware(['verified'])->name('dashboard');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});
