<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UssersController;

Route::get('/users', [UssersController::class, 'index']);
Route::post('/users', [UssersController::class, 'store']);
Route::get('/users/{id}', [UssersController::class, 'show']);
Route::put('/users/{id}', [UssersController::class, 'update']);
Route::delete('/users/{id}', [UssersController::class, 'destroy']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
