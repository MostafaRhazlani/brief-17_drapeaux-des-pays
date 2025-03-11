<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CountryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::post('/country/store', [CountryController::class, 'store'])->middleware('auth:sanctum');
Route::get('/countries', [CountryController::class, 'index'])->middleware('auth:sanctum');
Route::get('/country/{id}', [CountryController::class, 'show'])->middleware('auth:sanctum');
Route::put('/country/{id}/update', [CountryController::class, 'update'])->middleware('auth:sanctum');

