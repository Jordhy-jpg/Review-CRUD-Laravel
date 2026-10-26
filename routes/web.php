<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TaskController;

Route::get('/', [TaskController::class, 'index'])
    ->name('index');

Route::get('/create', [TaskController::class, 'create'])
    ->name('create');

Route::post('/create/store', [TaskController::class, 'store'])
    ->name('store');

// Route::get('/show/{task}', [TaskController::class,'show'])
// ->name('show');

Route::get('/edit/{task}', [TaskController::class, 'edit'])
    ->name('edit');

Route::put('/edit/update/{task}', [TaskController::class, 'update'])
    ->name('update');

Route::delete('/delete/{task}', [TaskController::class, 'delete'])
    ->name('delete');

Route::patch('edit/markAsComplete/{task}', [TaskController::class, 'markAsComplete'])
    ->name('markAsComplete');
