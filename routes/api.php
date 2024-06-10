<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PatientAPIController;
use App\Http\Controllers\API\DashboardAPIController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/dashboard', [DashboardAPIController::class, 'dashboard']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::resource('/patients', PatientAPIController::class);
});