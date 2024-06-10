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
        $patientByGroup = $this->getPatientByRiskCategory();

        $totalAppointments = $patientByGroup->sum('total_appointments');

        $percentages = $patientByGroup->map(function ($item) use ($totalAppointments) {
            $item['percentage'] = round(($item['total_appointments'] / $totalAppointments) * 100, 2);
            return $item;
        });

        return $percentages;
    }


    public function getTotalPatientsWaitingByWeekAndMonth()
    {
        $barChartData =$this->model->selectRaw('
                risk_category_id,
                YEAR(appointment_time) as year,
                MONTH(appointment_time) as month,
                WEEK(appointment_time) as week,
                COUNT(*) as total_patients
            ')
            ->groupBy('risk_category_id', 'year', 'month', 'week')
            ->orderBy('week')
            ->get();
        return $formattedData = $this->formatChartData($barChartData);
    }

    private function formatChartData($data)
    {
        $formatted = [];

        foreach ($data as $item) {
            $riskCategoryId = $item->riskcategory->category;
            $year = $item->year;
            $month = Carbon::createFromDate($year, $item->month)->format('F');
            $week = 'Week ' . $item->week;

            if (!isset($formatted[$riskCategoryId])) {
                $formatted[$riskCategoryId] = [
                    'risk_category' => $riskCategoryId, // Assuming you have risk category names or descriptions
                    'data' => [],
                ];
            }

            if (!isset($formatted[$riskCategoryId]['data'][$week])) {
                $formatted[$riskCategoryId]['data'][$week] = [
                    'month' => $month,
                    'total_patients' => 0,
                ];
            }

            $formatted[$riskCategoryId]['data'][$week]['total_patients'] += $item->total_patients;
        }
        return array_values($formatted); // Resetting keys for JSON response
    }

    public function getPatientByRiskCategory()
    {
        $patientByGroup = $this->model->join('risk_categories', 'appointments.risk_category_id', '=', 'risk_categories.id')
            ->select('risk_categories.id', 'risk_categories.category','risk_categories.description', DB::raw('COUNT(*) as total_appointments'))
            ->groupBy('risk_categories.id', 'risk_categories.category')
            ->orderBy('risk_categories.id')
            ->get();

        
        return $patientByGroup;
    }
}
