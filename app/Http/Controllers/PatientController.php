<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Http\Requests\CreatePatientRequest;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::all();
        return view('patients.index', compact('patients'));
    }

    public function create()
    {
        return view('patients.create');
    }

    public function store(CreatePatientRequest  $request)
    {
        // Validation passed, proceed to store the patient
        $validatedData = $request->validated();

        try {
            $patient = Patient::create($validatedData);
            return redirect()->route('patients.index')->with('success', 'Patient created successfully.');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Failed to create patient.']);
        }
    }

    // Show the form for editing the specified patient
    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }

    public function update(CreatePatientRequest  $request, Patient $patient)
    {
        // Validation passed, proceed to update the patient
        $validatedData = $request->validated();

        try {
            $patient->update($validatedData);
            return redirect()->route('patients.index')->with('success', 'Patient updated successfully.');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'Failed to update patient.']);
        }
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();

        return redirect()->route('patients.index')
                         ->with('success', 'Patient deleted successfully.');
    }
}
