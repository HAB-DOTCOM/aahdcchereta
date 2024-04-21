<?php

namespace App\Charts;

use App\Models\Bidder;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;
use DB;

class MonthlyBiddersChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build()
    {
        $bidders = Bidder::where('created_at', '>=', Carbon::now()->subDays(7))
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->groupBy('date')
            ->get();

        // Prepare chart data
        $labels = [];
        $series = [[
            'name' => 'Daily Bidders',
            'data' => [],
        ]];

        foreach ($bidders as $bidder) {
            $labels[] = $bidder->date;
            $series[0]['data'][] = $bidder->count;
        }

        $chart = new LarapexChart;
        $chart->setType('area');
        $chart->setLabels($labels);
        $chart->setDataset($series);
        $chart->setTitle('Daily Bidders in the Last 7 Days');

        return $chart;
    }
}
