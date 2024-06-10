<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreatePatientRequest;
use App\Repositories\PatientsRepository;
use App\Repositories\AppointmentRepository;
use App\Models\Patient;

class PatientAPIController extends Controller
{

    public function __construct(PatientsRepository $patientsRepository ,
                                AppointmentRepository $appointmentRepository
                                )
    {
        $this->patientsRepository       = $patientsRepository;
        $this->appointmentRepository    = $appointmentRepository;
    }


    /**
     * Display a listing of the patients.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = $this->patientsRepository->all();

        return response()->json($patients, 200);
    }

    /**
     * Store a newly created patient in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePatientRequest  $request)
    {
        try {
            $patient = $this->patientsRepository->create($request->all());
          
          return response()->json($patient, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create patient'], 500);
        }
    }

    /**
     * Display the specified patient.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $patient = $this->patientsRepository->find($id);

        if (!$patient) {
            return response()->json(['error' => 'Patient not found'], 404);
        }

        return response()->json($patient, 200);
    }

    /**
     * Update the specified patient in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreatePatientRequest  $request, Patient $patient)
    {
        $validatedData = $request->validated();
        
        if (!$patient) {
            return response()->json(['error' => 'Patient not found'], 404);
        }
        $patient = $this->patientsRepository->update($patient->id,$validatedData );
        
        return response()->json($patient, 200);
    }

    /**
     * Remove the specified patient from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patient = $this->patientsRepository->find($id);

        if (!$patient) {
            return response()->json(['error' => 'Patient not found'], 404);
        }

        $patient->delete();

        return response()->json(['success' => 'Patient Deleted'], 200);
    }
}
