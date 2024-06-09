<?php

namespace App\Repositories;

use App\Models\Doctors;


class DoctorsRepository extends BaseRepository
{
    public function __construct(Doctors $model)
    {
        parent::__construct($model);
    }

    
}
