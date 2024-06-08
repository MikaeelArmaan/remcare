<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Doctors;
use App\Models\Patient;
use App\Models\RiskCategory;
use Illuminate\Support\Facades\Validator;

class AppointmentsController extends Controller
{
    // Display a listing of appointments
    public function index()
    {
        $appointments = Appointment::all();
        return view('appointments.index', compact('appointments'));
    }

    // Show the form for creating a new appointment
    public function create()
    {
        $doctors = Doctors::all();
        $patients = Patient::all();
        $riskCategories = RiskCategory::all();
        return view('appointments.create', compact('doctors', 'patients', 'riskCategories'));
    }

    // Store a newly created appointment in storage
    public function store(CreateAppointmentRequest $request)
    {
        $validatedData = $request->validated();
        try {
            $appointment = Appointment::create($validatedData);
            return redirect()->route('doctors.index')->with('success', 'Appointment created successfully.');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Failed to create Appointment.']);
        }
    }

    // Show the form for editing the specified appointment
    public function edit(Appointment $appointment)
    {
        $doctors = Doctors::all();
        $patients = Patient::all();
        $riskCategories = RiskCategory::all();
        return view('appointments.edit', compact('appointment', 'doctors', 'patients', 'riskCategories'));
    }

    // Update the specified appointment in storage
    public function update(CreateAppointmentRequest $request, Appointment $appointment)
    {


        $appointment->update($request->all());

        return redirect()->route('appointments.index')
                         ->with('success', 'Appointment updated successfully.');
    }

    // Remove the specified appointment from storage
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()->route('appointments.index')
                         ->with('success', 'Appointment deleted successfully.');
    }
}
