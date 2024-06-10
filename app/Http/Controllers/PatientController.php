<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Http\Requests\CreatePatientRequest;
use App\Repositories\PatientsRepository;
use App\Repositories\AppointmentRepository;

class PatientController extends Controller
{
    public function __construct(PatientsRepository $patientsRepository ,
                                AppointmentRepository $appointmentRepository
                                )
    {
        $this->patientsRepository       = $patientsRepository;
        $this->appointmentRepository    = $appointmentRepository;
    }


    public function index(Request $request)
    {
        $patients = $this->patientsRepository->all();
        
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
            $patient = $this->patientsRepository->create($validatedData);
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
        
        $validatedData = $request->validated();

        try {
            $patient->update( $request->all());
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
