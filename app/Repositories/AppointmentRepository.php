<?php

namespace App\Repositories;

use App\Models\Appointment;
use Carbon\Carbon;

class AppointmentRepository extends BaseRepository
{
    public function __construct(Appointment $model)
    {
        parent::__construct($model);
    }

    public function checkAvailableDate($doctorId,Carbon $date){
        
        // Check if the doctor has any appointments on the given date
        $appointments = $this->model->where('doctor_id', $doctorId)
                                   ->whereDate('appointment_time', $date)
                                   ->get();
        // If there are no appointments, the doctor is available
        return $appointments->isEmpty();
    }
}
