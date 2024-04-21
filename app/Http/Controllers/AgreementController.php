<?php

namespace App\Http\Controllers;

use App\Models\Agreement;
use App\Models\Log;
use App\Models\HousesCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AgreementController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:agreements-view', ['only' => ['index','show']]);
        $this->middleware('permission:agreements-create', ['only' => ['create','store']]);
        $this->middleware('permission:agreements-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:agreements-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        try {
            // Log the action
            Log::create([
                'id' => Str::uuid(),
                'action' => 'Viewed agreements list',
                'user_id' => Auth::id(),
            ]);

            $agreements = Agreement::paginate(30);
            return view('admin.agreement.index', compact('agreements'));
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
            return view('admin.agreement.create', compact('categories'));
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            // Validate the request data
            $request->validate([
                'bidder_id'  => 'required|string|max:255',
                'house_id'  => 'required|string|max:255',
                'witness_fullname_1'  => 'required|string|max:255',
                'witness_subcity_1'  => 'required|string|max:255',
                'witness_wereda_1'  => 'required|string|max:255',
                'witness_houseno_1'  => 'required|string|max:255',
                'witness_date_1'  => 'required|string|max:255',
                'witness_fullname_2'  => 'required|string|max:255',
                'witness_subcity_2'  => 'required|string|max:255',
                'witness_wereda_2'  => 'required|string|max:255',
                'witness_houseno_2'  => 'required|string|max:255',
                'witness_date_2'  => 'required|string|max:255',
                'witness_fullname_3'  => 'required|string|max:255',
                'witness_subcity_3'  => 'required|string|max:255',
                'witness_wereda_3'  => 'required|string|max:255',
                'witness_houseno_3'  => 'required|string|max:255',
                'witness_date_3'  => 'required|string|max:255',
                'document'  => 'required|mimes:pdf',
            ]);
            if ($request->hasFile('document')) {
                $image = $request->file('document');
                $slug = Str::slug($request->bidder_id);
                if (isset($image)) {
                    $currentDate = Carbon::now()->toDateString();
                    $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
    
                    if (!file_exists('uploads/Agreement')) {
                        mkdir('uploads/Agreement', 0777, true);
                    }
                    $image->move('uploads/Agreement', $imagename);
                    $request->merge([
                        'document' => $imagename,
                    ]);
                }
            }
            $user = Auth::user();
            $request->merge([
                'added_by' => $user->id,
            ]);
            // Create a new agreement
            Agreement::create($request->all());

            // Log the action
            Log::create([
                'id' => Str::uuid(),
                'action' => 'Created a new agreement',
                'user_id' => Auth::id(),
            ]);

            return redirect()->route('admin.agreements')->with('success', 'ውል ተዋውሏል');
        } catch (\Throwable $e) {
            // Handle exception
            return back()->withErrors('Error occurred: ' . $e->getMessage())->withInput();
        }
    }

    public function show()
    {
        return view('admin.agreement.show', compact('agreement'));
    }

    public function edit(Agreement $agreement)
    {

        try {
            Log::create([
                'id' => Str::uuid(),
                'action' => 'Visited edit agreement form: ' . $agreement->name,
                'user_id' => auth()->id(),
            ]);

            $categories = HousesCategory::all();
            return view('admin.agreement.edit', compact('agreement', 'categories'));
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, Agreement $agreement)
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

            // Update the agreement
            $agreement->update($request->all());

            // Log the action
            Log::create([
                'id' => Str::uuid(),
                'action' => 'Updated agreement details',
                'user_id' => Auth::id(),
            ]);

            return redirect()->route('admin.agreements')->with('success', 'ቤት ዘምኗል.');
        } catch (\Throwable $e) {
            // Handle exception
            return back()->withErrors('Error occurred: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Agreement $agreement)
    {
        try {
            // Delete the agreement
            $agreement->delete();

            // Log the action
            Log::create([
                'id' => Str::uuid(),
                'action' => 'Deleted agreement',
                'user_id' => Auth::id(),
            ]);

            return redirect()->route('agreements.index')->with('success', 'ቤት ተሰርዟል.');
        } catch (\Throwable $e) {
            // Handle exception
            return back()->withErrors('Error occurred: ' . $e->getMessage());
        }
    }
}
