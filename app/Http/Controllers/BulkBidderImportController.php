<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\BiddersImport;
use Illuminate\Support\Str;
use App\Models\Log;
use App\Models\Station;

class BulkBidderImportController extends Controller
{
    public function __construct()
    {

        $this->middleware('permission:bidders-import-execute', ['only' => ['import']]);
    }

    public function showForm()
    {
        try {
            Log::create([
                'id' => Str::uuid(),
                'action' => 'Visited bulk bidder import form',
                'user_id' => auth()->id(),
            ]);
            // Fetch bidders stations  from the database and pass them to the view
            $stations = Station::all();

            return view('import.bidder_form', compact('stations')); // Make sure this view path is correct
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
                'action' => 'Imported bidders from Excel',
                'user_id' => auth()->id(),
            ]);

            $request->validate([
                'biider_station_id' => 'required|exists:stations,id',
                'file' => 'required|mimes:xlsx,xls',
            ]);
            $biider_station_id = $request->input('biider_station_id');
            $file = $request->file('file');

            // Import the data
            $import = new BiddersImport($biider_station_id);
            Excel::import($import, $file);
            // Check for import errors
            $errors = $import->getErrors();
            if (!empty($errors)) {
                return redirect()->back()->withErrors($errors);
            }

            return redirect()->route('admin.bidders')->with('success', 'በተሰካ ሁኔታ ቤቶች ተመዝግበዋል');
        // } catch (\Exception $e) {
        //     // Handle the exception, log or return an error message
        //     return redirect()->back()->with('error', $e->getMessage());
        // }
    }
}
