<?php

namespace App\Services;

use App\Models\Patient;
use App\Models\Doctors;
use App\Models\Appointment;
use Carbon\Carbon;
use App\Repositories\DoctorsRepository;
use App\Repositories\PatientsRepository;
use App\Repositories\RiskCategoriesRepository;
use App\Repositories\AppointmentRepository;

class AppointmentService
{
    public function __construct(DoctorsRepository $doctorsRepository,
                                PatientsRepository $patientsRepository,
                                AppointmentRepository $appointmentRepository,
                                RiskCategoriesRepository $riskCategoriesRepository,)
    {
        $this->doctorsRepository        = $doctorsRepository;
        $this->patientsRepository       = $patientsRepository;
        $this->riskCategoriesRepository = $riskCategoriesRepository;
        $this->appointmentRepository    = $appointmentRepository;
    }
    public function getAppointmentDateForPatient($formRequestData,$appointment =null)
    {
        
        $patient    = $this->patientsRepository->find($formRequestData['patient_id']);
        $doctor     = $this->doctorsRepository->find($formRequestData['doctor_id']);
        $dateTime   = isset($formRequestData['appointment_time'])? Carbon::parse($formRequestData['appointment_time']):false;
        $riskCategoriesRepository =  $this->riskCategoriesRepository->find($formRequestData['risk_category_id']);
        
        if($riskCategoriesRepository){
            switch ($riskCategoriesRepository->category) {
                case 'D':
                    $appointmentDate = $this->calculateAppointmentDate(1, 3, $doctor, $dateTime);
                    break;
                case 'C':
                    $appointmentDate = $this->calculateAppointmentDate(2, 4, $doctor, $dateTime);
                    break;
                case 'B':
                    $appointmentDate = $this->calculateAppointmentDate(4, 6, $doctor, $dateTime);
                    break;
                case 'A':
                    $appointmentDate = $this->calculateAppointmentDate(6, 10, $doctor, $dateTime);
                    break;
                default:
                    $appointmentDate = $this->calculateAppointmentDate(0, 1, $doctor, $dateTime);
            }
        }
        $formRequestData['appointment_time'] = $appointmentDate;
        if($appointment){
            return $this->appointmentRepository->update($appointment->id,$formRequestData);
        }
        return $this->appointmentRepository->create($formRequestData);
    }

    private function calculateAppointmentDate($min, $max, $doctor, $date)
    {
        $waitDay = rand($min, $max);
        $newDate = $date == true ?$date:Carbon::now()->addDays($waitDay);
        $isAvailableDate = $this->appointmentRepository->checkAvailableDate($doctor->id, $newDate);
        return ($isAvailableDate)?$newDate:$this->calculateAppointmentDate($min, $max, $doctor, $date->addDays($waitDay));
    }
}
