<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Model\Appointment;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'last_name',
        'email',
        'dob',
        'phone',
        'group',
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
