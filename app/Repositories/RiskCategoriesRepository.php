<?php

namespace App\Repositories;

use App\Models\RiskCategory;

class RiskCategoriesRepository extends BaseRepository
{
    public function __construct(RiskCategory $model)
    {
        parent::__construct($model);
    }
}
