<?php

use Illuminate\Support\Facades\Route;
use \Modules\Api\V1\Tasks\Controllers\TaskController;

Route::group(['prefix' => 'v1', 'middleware' => 'throttle:350,1'], function () {
    Route::apiResource('tasks', TaskController::class)->names([
        'index' => 'tasks.index',
        'store' => 'tasks.store',
        'update' => 'tasks.update',
        'destroy' => 'tasks.destroy',
    ]);
    Route::post('tasks/{task}/toggle', [TaskController::class, 'toggleComplete'])->name('tasks.toggle');
});
