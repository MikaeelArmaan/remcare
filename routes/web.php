<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\DoctorsController;
use App\Http\Controllers\RiskCategoryController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Patients
    Route::get('/patients', [PatientController::class, 'index'])->name('patients.index');
    Route::get('/patients/create', [PatientController::class, 'create'])->name('patients.create');
    Route::post('/patients', [PatientController::class, 'store'])->name('patients.store');
    Route::get('/patients/{patient}/edit', [PatientController::class, 'edit'])->name('patients.edit');
    Route::put('/patients/{patient}', [PatientController::class, 'update'])->name('patients.update');
    Route::delete('/patients/{patient}', [PatientController::class, 'destroy'])->name('patients.destroy');


    // Doctors
    Route::get('/doctors', [DoctorsController::class, 'index'])->name('doctors.index');
    Route::get('/doctors/create', [DoctorsController::class, 'create'])->name('doctors.create');
    Route::post('/doctors', [DoctorsController::class, 'store'])->name('doctors.store');
    Route::get('/doctors/{doctor}/edit', [DoctorsController::class, 'edit'])->name('doctors.edit');
    Route::put('/doctors/{doctor}', [DoctorsController::class, 'update'])->name('doctors.update');
    Route::delete('/doctors/{doctor}', [DoctorsController::class, 'destroy'])->name('doctors.destroy');

    // Appointments
    Route::get('/appointments', [AppointmentsController::class, 'index'])->name('appointments.index');
    Route::get('/appointments/create', [AppointmentsController::class, 'create'])->name('appointments.create');
    Route::post('/appointments', [AppointmentsController::class, 'store'])->name('appointments.store');
    Route::get('/appointments/{appointment}/edit', [AppointmentsController::class, 'edit'])->name('appointments.edit');
    Route::put('/appointments/{appointment}', [AppointmentsController::class, 'update'])->name('appointments.update');
    Route::delete('/appointments/{appointment}', [AppointmentsController::class, 'destroy'])->name('appointments.destroy');


    // Riskcategories
    Route::get('/riskcategories', [RiskCategoryController::class, 'index'])->name('riskcategories.index');
    Route::get('/riskcategories/create', [RiskCategoryController::class, 'create'])->name('riskcategories.create');
    Route::post('/riskcategories', [RiskCategoryController::class, 'store'])->name('riskcategories.store');
    Route::get('/riskcategories/{riskcategory}/edit', [RiskCategoryController::class, 'edit'])->name('riskcategories.edit');
    Route::put('/riskcategories/{riskcategory}', [RiskCategoryController::class, 'update'])->name('riskcategories.update');
    Route::delete('/riskcategories/{riskcategory}', [RiskCategoryController::class, 'destroy'])->name('riskcategories.destroy');
    //Route::resource('risk_categories', RiskCategoryController::class);

   

});

require __DIR__.'/auth.php';
