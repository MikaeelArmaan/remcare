<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Doctors;
use App\Models\Patient;
use App\Models\RiskCategory;
use App\Http\Requests\CreateAppointmentRequest;
use Illuminate\Support\Facades\Validator;
use App\Repositories\AppointmentRepository;
use App\Repositories\DoctorsRepository;
use App\Repositories\PatientsRepository;
use App\Repositories\RiskCategoriesRepository;
use App\Services\AppointmentService;

class AppointmentsController extends Controller
{
    public function __construct(AppointmentRepository $appointmentRepository,
                                DoctorsRepository $doctorsRepository,
                                PatientsRepository $patientsRepository,
                                RiskCategoriesRepository $riskCategoriesRepository,
                                AppointmentService $appointmentService,
                                )
    {
        $this->appointmentRepository    = $appointmentRepository;
        $this->doctorsRepository        = $doctorsRepository;
        $this->patientsRepository       = $patientsRepository;
        $this->riskCategoriesRepository = $riskCategoriesRepository;
        $this->appointmentService       = $appointmentService;
    }


    // Display a listing of appointments
    public function index()
    {
        $appointments = $this->appointmentRepository->all();
        return view('appointments.index', compact('appointments'));
    }

    // Show the form for creating a new appointment
    public function create()
    {
        $doctors        = $this->doctorsRepository->all();
        $patients       = $this->patientsRepository->all();
        $riskCategories = $this->riskCategoriesRepository->all();
        return view('appointments.create', compact('doctors', 'patients', 'riskCategories'));
    }

    // Store a newly created appointment in storage
    public function store(CreateAppointmentRequest $request)
    {
        $validatedData = $request->validated();
        try {
            $appointment = $this->appointmentService->getAppointmentDateForPatient($request->all());
            return redirect()->route('appointments.index')->with('success', 'Appointment created successfully.');
        } catch (\Exception $e) {
            dd($e);
            return back()->withInput()->withErrors(['error' => 'Failed to create Appointment.']);
        }
    }

    // Show the form for editing the specified appointment
    public function edit(Appointment $appointment)
    {
        $doctors        = $this->doctorsRepository->all();
        $patients       = $this->patientsRepository->all();
        $riskCategories = $this->riskCategoriesRepository->all();
        return view('appointments.edit', compact('appointment', 'doctors', 'patients', 'riskCategories'));
    }

    // Update the specified appointment in storage
    public function update(CreateAppointmentRequest $request, Appointment $appointment)
    {
        //$this->appointmentRepository->update($request->all());
        try {
            $validatedData = $request->validated();
            $appointment = $this->appointmentService->getAppointmentDateForPatient($request->all(),$appointment);
            return redirect()->route('appointments.index')
                         ->with('success', 'Appointment updated successfully.');
        } catch (\Exception $e) {
            dd($e);
            return back()->withInput()->withErrors(['error' => 'Failed to updated Appointment.']);
        }
    }

    // Remove the specified appointment from storage
    public function destroy($id)
    {
        $this->appointmentRepository->delete($id);

        return redirect()->route('appointments.index')
                         ->with('success', 'appointments deleted successfully.');
    }
}
