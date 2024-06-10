<?php
use App\Http\Controllers\PatientController;

//Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('patients', PatientController::class);
//});