<?php

use App\Http\Controllers\ApiKeyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::prefix('api-key')->group(function () {
        Route::post('/', [ApiKeyController::class, 'store'])->name('api-keys.store');
        Route::get('/', [ApiKeyController::class, 'list'])->name('api-keys.list');
        Route::get('/:id', [ApiKeyController::class, 'list'])->name('api-keys.edit');
        Route::post('/:id', [ApiKeyController::class, 'list'])->name('api-keys.update');
        Route::delete('/:id', [ApiKeyController::class, 'list'])->name('api-keys.destroy');
    });

    Route::prefix('users')->middleware('admin-role')->group(function () {
        Route::get('/', [UserController::class, 'list'])->name('users.list');
        Route::get('/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/', [UserController::class, 'store'])->name('users.store');
        Route::get('{id}', [UserController::class, 'edit'])->name('users.edit');
        Route::post('{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('{id}', [UserController::class, 'destroy'])->name('users.destroy');
    });

    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});

require __DIR__.'/auth.php';
