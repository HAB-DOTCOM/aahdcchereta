<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\Log;
use App\Models\HousesCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class HousesController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:houses-view', ['only' => ['index', 'show']]);
        $this->middleware('permission:houses-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:houses-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:houses-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        try {
            // Log the action
            Log::create([
                'id' => Str::uuid(),
                'action' => 'Viewed houses list',
                'user_id' => Auth::id(),
            ]);

            $houses = House::paginate(30);
            return view('admin.houses.index', compact('houses'));
        } catch (\Throwable $e) {
            // Handle exception
            return back()->withErrors('Error occurred: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            // Log the action
            Log::create([
                'id' => Str::uuid(),
                'action' => 'Visited create teacher form',
                'user_id' => auth()->id(),
            ]);

            $categories = HousesCategory::all();
            return view('admin.houses.create', compact('categories'));
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            // Validate the request data
            $request->validate([
                'building_number' => 'required|string|max:255',
                'sub_city_wereda' => 'required|string|max:255',
                'site_name' => 'required|string|max:255',
                'house_number' => 'required|string|max:255',
                'house_height' => 'required|numeric',
                'bedroom_number' => 'required|integer',
                'floor_number' => 'required|integer',
                'net_house_area' => 'required|numeric',
                'common_area' => 'required|numeric',
                'total_house_area' => 'required|numeric',
                'initial_price_per_square' => 'required|numeric',
                'category_id' => 'required',

            ]);
            $user = Auth::user();
            $request->merge([
                'added_by' => $user->id,
            ]);
            // Create a new house
            House::create($request->all());

            // Log the action
            Log::create([
                'id' => Str::uuid(),
                'action' => 'Created a new house',
                'user_id' => Auth::id(),
            ]);

            return redirect()->route('admin.houses')->with('success', 'ቤት ተመዝግቧል.');
        } catch (\Throwable $e) {
            // Handle exception
            return back()->withErrors('Error occurred: ' . $e->getMessage())->withInput();
        }
    }

    public function show(House $house)
    {

        $categories = HousesCategory::all();
        return view('admin.houses.show', compact('house', 'categories'));
    }

    public function edit(House $house)
    {

        try {
            Log::create([
                'id' => Str::uuid(),
                'action' => 'Visited edit house form: ' . $house->name,
                'user_id' => auth()->id(),
            ]);

            $categories = HousesCategory::all();
            return view('admin.houses.edit', compact('house', 'categories'));
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, House $house)
    {
        try {
            // Validate the request data
            $request->validate([
                'building_number' => 'required|string',
                'sub_city_wereda' => 'required|string',
                'site_name' => 'required|string',
                'house_number' => 'required|string',
                'house_height' => 'required|numeric',
                'bedroom_number' => 'required|numeric',
                'floor_number' => 'required|numeric',
                'net_house_area' => 'required|numeric',
                'common_area' => 'required|numeric',
                'total_house_area' => 'required|numeric',
                'initial_price_per_square' => 'required|numeric',
                'category_id' => 'required|exists:houses_categories,id',
            ]);

            // Update the house
            $house->update($request->all());

            // Log the action
            Log::create([
                'id' => Str::uuid(),
                'action' => 'Updated house details',
                'user_id' => Auth::id(),
            ]);

            return redirect()->route('admin.houses')->with('success', 'ቤት ዘምኗል.');
        } catch (\Throwable $e) {
            // Handle exception
            return back()->withErrors('Error occurred: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(House $house)
    {
        try {
            // Delete the house
            $house->delete();

            // Log the action
            Log::create([
                'id' => Str::uuid(),
                'action' => 'Deleted house',
                'user_id' => Auth::id(),
            ]);

            return redirect()->route('houses.index')->with('success', 'ቤት ተሰርዟል.');
        } catch (\Throwable $e) {
            // Handle exception
            return back()->withErrors('Error occurred: ' . $e->getMessage());
        }
    }
}
