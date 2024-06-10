<?php


namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\AppointmentRepository;
use App\Repositories\DoctorsRepository;
use App\Repositories\PatientsRepository;
use App\Repositories\RiskCategoriesRepository;

class DashboardAPIController extends Controller
{

    public function __construct(AppointmentRepository $appointmentRepository,
                                DoctorsRepository $doctorsRepository,
                                PatientsRepository $patientsRepository,
                                RiskCategoriesRepository $riskCategoriesRepository,
                                )
    {
        $this->appointmentRepository    = $appointmentRepository;
        $this->doctorsRepository        = $doctorsRepository;
        $this->patientsRepository       = $patientsRepository;
        $this->riskCategoriesRepository = $riskCategoriesRepository;
    }


    public function dashboard()
    {
        $pieData = $this->appointmentRepository->getPercentagesByRiskCategory();
        $barData = $this->appointmentRepository->getTotalPatientsWaitingByWeekAndMonth();
        $data = ['pieData'=>$pieData,
                'barData' =>$barData
                ];
        return response()->json($data, 200);
    }
    
}
