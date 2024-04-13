<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::middleware('api-key')->group(function () {
    Route::post('/tasks', [TaskController::class, 'create']);
});
