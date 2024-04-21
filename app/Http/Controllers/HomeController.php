<?php

namespace App\Http\Controllers;

use App\Charts\HouseCategoryChart;
use App\Charts\MonthlyBiddersChart;
use App\Models\Bidder;
use App\Models\House;
use App\Models\HousesCategory;
use App\Models\Log;
use App\Models\User;
use Illuminate\Http\Request;
use ArielMejiadev\LarapexCharts\LarapexChart;
use Carbon\Carbon;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(HouseCategoryChart $chart, MonthlyBiddersChart $chart2)
    {
        try {
            $bidders = Bidder::where('created_at', '>=', Carbon::now()->subDays(30))
                ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
                ->groupBy('date')
                ->get();

            // Prepare chart data
            $labels = [];
            $series = [[
                'name' => 'ዕለታዊ ተጫራቾች',
                'data' => [],
            ]];

            foreach ($bidders as $bidder) {
                $labels[] = $bidder->date;
                $series[0]['data'][] = $bidder->count;
            }

            $chart2 = new LarapexChart;
            $chart2->setType('area');
            $chart2->setLabels($labels);
            $chart2->setDataset($series);
            $chart2->setTitle('ባለፉት 30 ቀናት ውስጥ ዕለታዊ ተጫራቾች');
            $houses = House::all()->count();
            $logs = Log::all()->count();
            $users = User::all()->count();
            $bidders = Bidder::all()->count();
            $housescategory = HousesCategory::all()->count();
            return view('admin.dashboard', [
                'chart' => $chart->build(),
                'chart2' => $chart2,
                'houses' => $houses,
                'logs' => $logs,
                'users' => $users,
                'bidders' => $bidders,
                'housescategory' => $housescategory,
            ]);
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }
}
