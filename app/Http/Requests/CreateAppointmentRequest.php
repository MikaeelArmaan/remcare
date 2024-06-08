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
        return [
            'doctor_id' => 'required',
            'patient_id' => 'required',
            'appointment_time' => [
                'required',
                'date',
                'after:now',
                new UniqueDoctorAppointment($request->doctor_id, $request->appointment_time)
            ],
            'risk_category_id' => 'required',
        ];
    }

    // Define custom validation messages
    public function messages()
    {
        return [
            'doctor_id.required' => 'Please select Doctor',
            'patient_id.required' => 'Please select Patient',
            'appointment_time.required' => 'Appointment date is required',
            'appointment_time.after' => 'The appointment date must be a future date',
            'risk_category_id.required' => 'Risk Category is required',
        ];
    }
}
