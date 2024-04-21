<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bidder;
use App\Models\House;
use App\Models\Log;
use App\Models\HousesCategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DisqualifiedBidderController extends Controller
{
    public function __construct()
    {
        // Apply middleware for specific permissions
        $this->middleware('permission:disqualified-bidders-view', ['only' => ['index']]);
        $this->middleware('permission:disqualified-bidders-update', ['only' => ['updateForm', 'disqualifiedBidderWithSpecialReason']]);
    }
    public function index()
    {
        try {
            $specialReasonBidders = Bidder::where('special_reason', '<>', 'Disqualified')->get();
            return view('admin.bidders.disqualified_bidders', compact('specialReasonBidders'));
        } catch (\Throwable $th) {
            return redirect()->back();
        }
        // Fetch all bidders with a special reason
    }

    public function updateForm()
    {
        try {
            $bidderNumbers = Bidder::pluck('receipt_number');
            $categories = HousesCategory::all();
            return view('admin.bidders.disqualified_bidders_update_form', compact('bidderNumbers', 'categories'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function disqualifiedBidderWithSpecialReason(Request $request)
    {

        $request->validate([
            // 'age' => 'required',
            'is_disabled' => 'required',
            // 'region' => 'required',
            // 'sub_city' => 'required',
            // 'wereda' => 'required',
            // 'bidder_house_number' => 'required',
            // 'id_number' => 'required',
            // 'nationality' => 'required',
            'house_category_id' => 'required',
            'house_number' => 'required',
            'price_per_square' => 'required',
            'total_price' => 'required',
            'cpo_amount' => 'required',
            'cpo_number' => 'required',
            'cpo_Bank_branch' => 'required',
            'cpo_Bank_name' => 'required',
            'cpo_person_name' => 'required',
            'cpo_Bank_account' => 'required',
            'special_reason' => 'required',
        ]);
        try {
            DB::beginTransaction();

            // Fetch the bidder by receipt number
            $bidder = Bidder::where('receipt_number', $request->input('receipt_number'))->first();

            // Check if the full name, gender, and recipient number match the selected bidder
            if (
                $bidder->receipt_number != $request->input('receipt_number')
            ) {
                // throw new \Exception("Unable to update bidder's name, gender, and recipient number due to mismatch.");
                throw new \Exception("በተዛመደ አለመመጣጠን ምክንያት የተጫራቹን ስም፣ ጾታ እና የተቀባይ ቁጥር ማዘመን አልተቻለም.");
            }
            // Check if bidder exists
            if (!$bidder) {
                throw new \Exception("Bidder with the provided receipt number does not exist.");
            }

            // Fetch the selected house
            $selectedHouse = House::where('house_number', $request->input('house_number'))->first();


            // Check if the selected house belongs to the selected house category
            // Assuming you have a category_id associated with each house
            if ($selectedHouse->category_id != $request->input('house_category_id')) {
                throw new \Exception("The selected house does not belong to the selected house category.");
            }

            // Update bidder information
            $totalPrice = $request->input('total_price'); // Assuming $totalPrice is available
            $bidder->fill($request->all() + ['total_price' => $totalPrice ?? null]);
            $bidder->updated_by = Auth::id();
            $bidder->status = 'Disqualified';
            $bidder->special_reason = $request->input('special_reason');
            $bidder->save();

            // Attach the bidder to the house in the pivot table
            $selectedHouse->bidders()->attach($bidder->id);

            DB::commit();

            return redirect()->route('disqualifiedBidders')->with('success', 'የተጫራች መረጃ ዘምኗል.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
