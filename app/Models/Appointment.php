<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Doctors;
use App\Models\Patient;
use App\Models\RiskCategory;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'patient_id',
        'appointment_time',
        'notes',
        'risk_category_id',
    ];


    public function doctor()
    {
        return $this->belongsTo(Doctors::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function riskCategory()
    {
        return $this->belongsTo(RiskCategory::class, 'risk_category_id');
    }
}
