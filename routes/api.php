<?php
use App\Http\Controllers\PatientController;

Route::get('/patients-by-risk-group', [PatientController::class, 'getPatientsByRiskGroup']);
Route::get('/patients-waiting-by-week-month', [PatientController::class, 'getPatientsWaitingByWeekMonth']);
