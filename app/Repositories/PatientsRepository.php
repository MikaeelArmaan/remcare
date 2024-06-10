<?php

namespace App\Repositories;

use App\Models\Patient;
use Carbon\Carbon;

class PatientsRepository extends BaseRepository
{
    public function __construct(Patient $model)
    {
        parent::__construct($model);
    }

    public function create(array $data){
        if($data['dob']){
            $data['dob'] = Carbon::parse($data['dob'])->format('Y-m-d');
        }
        return $this->model->create($data);
    }
    
    public function update($id, array $data){
        if($data['dob']){
            $data['dob'] = Carbon::parse($data['dob'])->format('Y-m-d');
        }
        return parent::update($id,$data);
    }
}
