<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateDoctorRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Change to implement authorization logic if needed
    }

    public function rules()
    {
        $doctorId = $this->route('doctor') ? $this->route('doctor')->id : null;
        return [
            'name' => 'required|string|max:255|unique:doctors,name,' . $doctorId,
            'specialization' => 'required|string',
            'experience' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than :max characters.',
            'specialization.string' => 'The specialization must be a string.',
            'specialization.required' => 'The specialization field is required.',
            'experience.required' => 'The experience field is required.',
            'experience.integer' => 'The experience must be an integer.',
            ];
    }
}
