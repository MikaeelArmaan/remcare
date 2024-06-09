<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    protected $model = Patient::class;

    public function definition()
    {
        return [
            'name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'dob' => $this->faker->date(),
            'phone' => $this->faker->phoneNumber,
            'group' => $this->faker->randomElement(['A', 'B', 'C', 'D']),
        ];
    }
}
