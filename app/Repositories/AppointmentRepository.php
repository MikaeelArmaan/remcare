<?php

namespace App\Repositories;

use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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

    public function getPercentagesByRiskCategory()
    {
        $percentages = $this->model->join('risk_categories', 'appointments.risk_category_id', '=', 'risk_categories.id')
            ->select('risk_categories.id', 'risk_categories.category','risk_categories.description', DB::raw('COUNT(*) as total_appointments'))
            ->groupBy('risk_categories.id', 'risk_categories.category')
            ->orderBy('risk_categories.id')
            ->get();

        $totalAppointments = $percentages->sum('total_appointments');

        $percentages = $percentages->map(function ($item) use ($totalAppointments) {
            $item['percentage'] = round(($item['total_appointments'] / $totalAppointments) * 100, 2);
            return $item;
        });

        return $percentages;
    }


    public function getTotalPatientsWaitingByWeekAndMonth()
    {
        // Group by week and month, and count appointments for each risk category
        $data = $this->model
            ->join('risk_categories', 'appointments.risk_category_id', '=', 'risk_categories.id')
            ->select(
                'risk_categories.id',
                'risk_categories.category as risk_category',
                DB::raw('WEEK(appointments.appointment_time) as week_number'),
                DB::raw('MONTHNAME(appointments.appointment_time) as month_label'),
                DB::raw('COUNT(*) as total_patients')
            )
            ->groupBy('risk_categories.id', 'risk_category', 'week_number', 'month_label')
            ->orderBy('risk_categories.id', 'asc')
            ->orderBy('month_label', 'asc')
            ->orderBy('week_number', 'asc')
            ->get();

        return $data;
    }
}
