<?php

use App\Http\Controllers\Api\TodoController;
use Illuminate\Support\Facades\Route;

Route::apiResource('todos', TodoController::class)->except([
  'show'
]);

Route::controller(TodoController::class)->group(function () {
  Route::patch('/todos', 'check_all');
  Route::delete('/todos', 'clear_completed');
});
