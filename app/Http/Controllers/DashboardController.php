<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\AppointmentRepository;
use App\Repositories\DoctorsRepository;
use App\Repositories\PatientsRepository;
use App\Repositories\RiskCategoriesRepository;

class DashboardController extends Controller
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
        return view('charts.dashboard', compact('pieData', 'barData'));
    }
    
}
