<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctors;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\CreateDoctorRequest;

class DoctorsController extends Controller
{
    // Display a listing of doctors
    public function index()
    {
        $doctors = Doctors::all();
        return view('doctors.index', compact('doctors'));
    }

    // Show the form for creating a new doctor
    public function create()
    {
        return view('doctors.create');
    }

    public function store(CreateDoctorRequest  $request)
    {
        $validatedData = $request->validated();
        try {
            $doctor = Doctors::create($validatedData);
            return redirect()->route('doctors.index')->with('success', 'Doctor created successfully.');
        } catch (\Exception $e) {
            dd($e);
            return back()->withInput()->withErrors(['error' => 'Failed to create doctor.']);
        }
    }

    // Show the form for editing the specified doctor
    public function edit(Doctors $doctor)
    {
        return view('doctors.edit', compact('doctor'));
    }

    // Update the specified doctor in storage
    public function update(CreateDoctorRequest $request, Doctors $doctor)
    {
        $validatedData = $request->validated();

        try {
            $doctor->update($request->all());
            return redirect()->route('doctors.index')->with('success', 'Doctor updated successfully.');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Failed to create doctor.']);
        }
    }

    // Remove the specified doctor from storage
    public function destroy(Doctors $doctor)
    {
        $doctor->delete();

        return redirect()->route('doctors.index')
                         ->with('success', 'Doctor deleted successfully.');
    }
}
