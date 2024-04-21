<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\HouseImport;
use Illuminate\Support\Str;
use App\Models\Log;
use App\Models\HousesCategory;
use App\Imports\MHouseImport;

class BulkHouseController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:houses-import-execute', ['only' => ['import']]);
    }
    public function showForm()
    {
        try {
            Log::create([
                'id' => Str::uuid(),
                'action' => 'Visited bulk house import form',
                'user_id' => auth()->id(),
            ]);
            // Fetch houses categories from the database and pass them to the view
            $categories = HousesCategory::all();
            return view('import.houses_form', compact('categories')); // Make sure this view path is correct
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function import(Request $request)
    {
        // try {
            // Log the action
            Log::create([
                'id' => Str::uuid(),
                'action' => 'Imported houses from Excel',
                'user_id' => auth()->id(),
            ]);

            $request->validate([
                'category_id' => 'required|exists:houses_categories,id',
                'file' => 'required|mimes:xlsx,xls',
            ]);

            $categoryId = $request->input('category_id');
            $file = $request->file('file');

            // Import the data
            $import = new HouseImport($categoryId);
            Excel::import($import, $file);

            // Check for import errors
            $errors = $import->getErrors();
            if (!empty($errors)) {
                return redirect()->back()->withErrors($errors);
            }

            return redirect()->route('admin.houses')->with('success', 'ቤቶች ተመዝግበዋል.');
        // } catch (\Exception $e) {
        //     // Handle the exception, log or return an error message
        //     return redirect()->back()->with('error', $e->getMessage());
        // }
    }
    public function mshowForm()
    {
        try {
            Log::create([
                'id' => Str::uuid(),
                'action' => 'Visited bulk house import form',
                'user_id' => auth()->id(),
            ]);
            // Fetch houses categories from the database and pass them to the view
            $categories = HousesCategory::all();
            return view('import.mhouses_form', compact('categories')); // Make sure this view path is correct
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function Mimport(Request $request)
    {
        // try {
        // Log the action
        Log::create([
            'id' => Str::uuid(),
            'action' => 'Imported houses from Excel',
            'user_id' => auth()->id(),
        ]);

        $request->validate([
            'category_id' => 'required|exists:houses_categories,id',
            'file' => 'required|mimes:xlsx,xls',
        ]);

        $categoryId = $request->input('category_id');
        $file = $request->file('file');

        // Import the data
        $import = new MHouseImport($categoryId);
        Excel::import($import, $file);

        // Check for import errors
        $errors = $import->getErrors();
        if (!empty($errors)) {
            return redirect()->back()->withErrors($errors);
        }

        return redirect()->route('admin.houses')->with('success', 'ቤቶች ተመዝግበዋል.');
        // } catch (\Exception $e) {
        //     // Handle the exception, log or return an error message
        //     return redirect()->back()->with('error', $e->getMessage());
        // }
    }
}
