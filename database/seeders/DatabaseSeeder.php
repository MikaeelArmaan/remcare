<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RiskCategory;
use App\Models\Patient;
use App\Models\Doctors;
use App\Models\Appointment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([
            RiskCategorySeeder::class,
        ]);
        Doctors::factory(10)->create();
        Patient::factory(100)->create();
        Appointment::factory(500)->create();
    }
}
