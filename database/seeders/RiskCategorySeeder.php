<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RiskCategory;

class RiskCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['category' => 'A','description' => 'Low Risk Group'],
            ['category' => 'B','description' => 'normal Risk Group'],
            ['category' => 'C','description' => 'High Risk Group'],
            ['category' => 'D','description' => 'Highest Risk Group'],
        ];

        foreach ($categories as $category) {
            RiskCategory::create($category);
        }
    }
}
