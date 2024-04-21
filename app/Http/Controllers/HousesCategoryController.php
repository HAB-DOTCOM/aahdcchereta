<?php

namespace App\Http\Controllers;

use App\Models\HousesCategory;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class HousesCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:houses-categories-view', ['only' => ['index', 'show']]);
        $this->middleware('permission:houses-categories-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:houses-categories-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:houses-categories-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        try {
            // Log the action
            Log::create([
                'id' => Str::uuid(),
                'action' => 'Viewed teacher categories list',
                'user_id' => Auth::id(),
            ]);

            $housecategories = HousesCategory::all();
            return view('admin.housecategories.index', compact('housecategories'));
        } catch (\Throwable $e) {
            // Handle exception
            return back()->withErrors('Error occurred: ' . $e->getMessage());
        }
    }

    public function create()
    {
        return view('admin.housecategories.create');
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required',
                'description' => 'required',
            ]);
            HousesCategory::create([
                'name' => $request->name,
                'created_by' => Auth::user()->id,
                'description' => $request->description,
            ]);
            // Log the action
            Log::create([
                'id' => Str::uuid(),
                'action' => 'Created a new houses category',
                'user_id' => Auth::id(),
            ]);

            return redirect()->route('admin.housecategories')->with('success', 'የቤት ምድብ ተመዝግቧል.');
        } catch (\Throwable $e) {

            return back()->withErrors('Error occurred: ' . $e->getMessage())->withInput();
        }
    }

    public function show($id)
    {
        $category = HousesCategory::find($id);
        return view('admin.housecategories.show', compact('category'));
    }

    public function edit($id)
    {
        $category = HousesCategory::find($id);
        return view('admin.housecategories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'name' => 'required',
                'description' => 'required',
            ]);
            $category = HousesCategory::find($id);
            $category->name = $request->name;
            $category->description = $request->description;
            $category->save();

            Log::create([
                'id' => Str::uuid(),
                'action' => 'Updated houses category details',
                'user_id' => Auth::id(),
            ]);

            return redirect()->route('admin.housecategories')->with('success', 'የቤት ምድብ ዘምኗል.');
        } catch (\Throwable $e) {
            // Handle exception
            return back()->withErrors('Error occurred: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(HousesCategory $housesCategory)
    {
        try {
            // Delete the teacher category
            $housesCategory->delete();

            // Log the action
            Log::create([
                'id' => Str::uuid(),
                'action' => 'Deleted teacher category',
                'user_id' => Auth::id(),
            ]);

            return redirect()->route('admin.housecategories')->with('success', 'የቤት ምድብ ተሰርዟል.');
        } catch (\Throwable $e) {
            // Handle exception
            return back()->withErrors('Error occurred: ' . $e->getMessage());
        }
    }
}
