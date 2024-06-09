<?php

namespace Database\Factories;

use App\Models\Doctors;
use Illuminate\Database\Eloquent\Factories\Factory;

class DoctorsFactory extends Factory
{
    protected $model = Doctors::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'specialization' => $this->faker->randomElement(['Cardiologist', 'Pediatrician', 'Neurologist']),
            'experience' => $this->faker->numberBetween(1, 30), // Assuming experience is in years
        ];
    }
}
