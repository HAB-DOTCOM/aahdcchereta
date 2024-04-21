<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;
use App\Models\User;
use App\Models\Station;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
class StationsController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('permission:station-view', ['only' => ['index','show']]);
    //     $this->middleware('permission:station-create', ['only' => ['create','store']]);
    //     $this->middleware('permission:station-edit', ['only' => ['edit','update']]);
    //     $this->middleware('permission:station-delete', ['only' => ['destroy']]);
    // }

    public function index()
    {
        try {
            // Log the action
            Log::create([
                'id' => Str::uuid(),
                'action' => 'Viewed stations list',
                'user_id' => Auth::id(),
            ]);

            $stations = Station::all();
            return view('admin.stations.index', compact('stations'));
        } catch (\Throwable $e) {
            // Handle exception
            return back()->withErrors('Error occurred: ' . $e->getMessage());
        }
    }

    public function create()
    {
        return view('admin.stations.create');
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required',
                'description' => 'required',
            ]);
            Station::create([
                'name' => $request->name,
                'created_by' => Auth::user()->id,
                'description' => $request->description,
            ]);
            // Log the action
            Log::create([
                'id' => Str::uuid(),
                'action' => 'Created a new bidders station ',
                'user_id' => Auth::id(),
            ]);

            return redirect()->route('admin.bidderstation')->with('success', 'የዝገባ ጣቢያ ተመዝግቧል.');
        } catch (\Throwable $e) {

            return back()->withErrors('Error occurred: ' . $e->getMessage())->withInput();
        }
    }

    public function show($id)
    {
        $station = Station::find($id);
        return view('admin.stations.show', compact('station'));
    }

    public function edit($id)
    {
        $station = Station::find($id);
        return view('admin.stations.edit', compact('station'));
    }
    
    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'name' => 'required',
                'description' => 'required',
            ]);
            $category = Station::find($id);
            $category->name = $request->name;
            $category->description = $request->description;
            $category->save();

            Log::create([
                'id' => Str::uuid(),
                'action' => 'Updated bidders station details',
                'user_id' => Auth::id(),
            ]);

            return redirect()->route('admin.bidderstation')->with('success', 'የምዝገባ ጣቢያ ዘምኗል.');
        } catch (\Throwable $e) {
            // Handle exception
            return back()->withErrors('Error occurred: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Station $station)
    {
        try {
            // Delete the teacher category
            $station->delete();

            // Log the action
            Log::create([
                'id' => Str::uuid(),
                'action' => 'Deleted bidders station',
                'user_id' => Auth::id(),
            ]);

            return redirect()->route('admin.bidderstation')->with('success', 'የምዝገባ ጣቢያ ተሰርዟል.');
        } catch (\Throwable $e) {
            // Handle exception
            return back()->withErrors('Error occurred: ' . $e->getMessage());
        }
    }
}
