<?php

namespace Database\Factories;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\RiskCategory;

class AppointmentFactory extends Factory
{
    protected $model = Appointment::class;

    public function definition()
    {
        return [
            'doctor_id' => \App\Models\Doctors::factory(),
            'patient_id' => \App\Models\Patient::factory(),
            'appointment_time' => $this->faker->dateTimeBetween('+1 day', '+2 month'),
            'notes' => $this->faker->sentence(),
            'risk_category_id' => RiskCategory::all()->random()->id
        ];
    }
}
