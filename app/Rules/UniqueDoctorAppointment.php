<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Appointment;

class UniqueDoctorAppointment implements Rule
{
    protected $doctor_id;
    protected $appointment_time;

    public function __construct($doctor_id, $appointment_time)
    {
        $this->doctor_id = $doctor_id;
        $this->appointment_time = $appointment_time;
    }

    public function passes($attribute, $value)
    {
        // Check if there is any appointment for the same doctor at the given time
        return !Appointment::where('doctor_id', $this->doctor_id)
                           ->where('appointment_time', $this->appointment_time)
                           ->exists();
    }

    public function message()
    {
        return 'An appointment for this doctor at the same time already exists.';
    }
}
