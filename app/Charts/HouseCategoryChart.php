<?php

namespace App\Charts;

use App\Models\House;
use App\Models\HousesCategory;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class HouseCategoryChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build()
    {
        $categories = HousesCategory::all();

        return $this->chart->pieChart()
            ->setTitle('ቤቶች በምድብ')
            ->addData([
                \App\Models\House::where('category_id', '=', $categories[0]->id)->count(),
                \App\Models\House::where('category_id', '=', $categories[1]->id)->count(),
            ])
            ->setColors(['#ffc63b', '#ff6384'])
            ->setLabels([$categories[0]->name, $categories[1]->name]);
    }
}
