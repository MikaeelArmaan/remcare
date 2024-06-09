<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\UniqueDoctorAppointment;

class CreateAppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    // Define validation rules dynamically
    public function rules()
    {
        $rules = [
            'doctor_id' => 'required',
            'patient_id' => 'required',
            'risk_category_id' => 'required',
        ];
        // Check appointment_time rule only if appointment_time input is given
        if ($this->has('appointment_time') && !empty($this->input('appointment_time'))) {
            $rules['appointment_time'] = [
                'required',
                'date',
                'after:now',
                new UniqueDoctorAppointment($this->request->get('doctor_id'),
                $this->request->get('appointment_time'),
                isset($this->appointment)?$this->appointment->id:null)
            ];
        }
        return $rules;
    }

    // Define custom validation messages
    public function messages()
    {
        $message = [
            'doctor_id.required' => 'Please select Doctor',
            'patient_id.required' => 'Please select Patient',
        ];
        if ($this->has('appointment_time') && !empty($this->input('appointment_time'))) {
            $message +=[
                'appointment_time.required' => 'The appointment date and time is required.',
                'appointment_time.date' => 'The appointment date and time must be a valid date.',
                'appointment_time.after' => 'The appointment date and time must be in the future.',
                'appointment_time.unique_doctor_appointment' => 'An appointment for this doctor at the same time already exists.'
            ];
        }
        return $message;
    }
}
