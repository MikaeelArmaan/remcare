<?php

namespace App\Repositories;

use App\Models\Patient;

class PatientsRepository extends BaseRepository
{
    public function __construct(Patient $model)
    {
        parent::__construct($model);
    }
}
