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
use App\Models\Station;
use Spatie\LaravelPdf\Facades\PDF;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

use TCPDF;

class MYPDF extends TCPDF
{
    // Header method overriding to customize the header for every page
    public function Header()
    {
        // Define the A4 page width in inches
        $a4_width_inches = 8.27;

        // Convert A4 page width from inches to millimeters
        $a4_width_mm = $a4_width_inches * 25.4;

        // Calculate the proportional width for the header image
        $header_width = $a4_width_mm * 0.8; // Adjust the proportion (0.8) as needed

        // Define the margins as variables for better readability and adjustment
        $margin_left = ($this->GetPageWidth() - $header_width) / 2; // Center the image horizontally
        $margin_top = 5; // The top margin for the header image positioning

        // Calculate the header image height to maintain aspect ratio
        // Assuming you know your image's original size, you can calculate the proportional height
        // Example: If original size is 1900 x 400 (width x height) and you resize width to 275,
        // then new height = (275 * original height) / original width
        $header_height = ($header_width * 400) / 1900; // Adjust 400 and 1900 to your actual image's dimensions

        // Insert the header image
        // Adjust image position and size according to your needs
        $this->Image(public_path('assets\AuctionManagement\assets\header.png'), $margin_left, $margin_top, $header_width, $header_height, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
    }
}
class BidderAdditionalDetailsController extends Controller
{
    public function __construct()
    {
        // Apply middleware for specific permissions
        $this->middleware('permission:view-bidders-disqualifiedBidders-system', ['only' => ['disqualifiedBidders']]);
        $this->middleware('permission:view-bidders-topBidders', ['only' => ['topBidders']]);
        $this->middleware('permission:view-bidders-list', ['only' => ['index']]);
        $this->middleware('permission:create-bidder', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-bidder', ['only' => ['edit', 'updatepage', 'update']]);
        $this->middleware('permission:view-bidder', ['only' => ['show']]);
    }

    public function index()
    {
        try {
            // Log the action
            Log::create([
                'id' => Str::uuid(),
                'action' => 'Viewed Bidders list',
                'user_id' => Auth::id(),
            ]);

            $bidders = Bidder::paginate(30);
            return view('admin.bidders.index', compact('bidders'));
        } catch (\Throwable $e) {
            // Handle exception
            return back()->withErrors('Error occurred: ' . $e->getMessage());
        }
    }
    public function create()
    {
        try {
            $stations = Station::all();
            return view('admin.bidders.create', compact('stations'));
        } catch (\Throwable $e) {
            // Handle exception
            return back()->withErrors('Error occurred: ' . $e->getMessage());
        }
    }
    public function edit($id)
    {
        try {
            $stations = Station::all();
            $bidder = Bidder::find($id);
            return view('admin.bidders.edit', compact('stations', 'bidder'));
        } catch (\Throwable $e) {
            // Handle exception
            return back()->withErrors('Error occurred: ' . $e->getMessage());
        }
    }
    public function show($id)
    {
        try {
            $stations = Station::all();
            $bidder = Bidder::find($id);
            return view('admin.bidders.show', compact('stations', 'bidder'));
        } catch (\Throwable $e) {
            // Handle exception
            return back()->withErrors('Error occurred: ' . $e->getMessage());
        }
    }
    public function store(Request $request)
    {
        // Validate request data
        $request->validate([
            'full_name' => 'required',
            'phone' => 'required',
            'receipt_number' => 'required|unique:bidders',
            'gender' => 'required',
            'biider_station_id' => 'required',
        ]);

        try {
            DB::beginTransaction();

            // Create a new bidder instance
            $bidder = new Bidder();
            $bidder->full_name = $request->input('full_name');
            $bidder->phone = $request->input('phone');
            $bidder->receipt_number = $request->input('receipt_number');
            $bidder->gender = $request->input('gender');
            $bidder->added_by = Auth::id();
            $bidder->biider_station_id = $request->input('biider_station_id');
            $bidder->save();

            DB::commit();

            return redirect()->route('admin.bidders')->with('success', 'ተጫራች ተመዝግቧል.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function updatepage()
    {
        // Retrieve all bidder numbers from the database
        $bidderNumbers = Bidder::pluck('receipt_number');
        $categories = HousesCategory::all();
        return view('admin.bidders.update', compact('bidderNumbers', 'categories'));
    }

    public function update(Request $request)
{
    $request->validate([
        'is_disabled' => 'required',
        'house_category_id' => 'required',
        'house_number' => 'required',
        'price_per_square' => 'required',
        'cpo_amount' => 'required',
        'cpo_number' => 'required',
        'cpo_Bank_branch' => 'required',
        'cpo_Bank_name' => 'required',
        'cpo_person_name' => 'required',
        'cpo_Bank_account' => 'required',
    ]);

    DB::beginTransaction();

    $bidder = Bidder::where('receipt_number', $request->input('receipt_number'))->first();
    $selectedHouse = House::where('house_number', $request->input('house_number'))->first();

    // Check if the bidder has already updated their information for a different house
    $previousHouseId = $bidder->house_id ?? null;
    if ($previousHouseId && $previousHouseId != $selectedHouse->id) {
        throw new \Exception("ተጫራቾች ለተመሳሳይ ቤት መረጃን ብዙ ጊዜ ማዘመን ይችላሉ።");
    }

    // Check if the selected house belongs to the selected house category
    if ($selectedHouse->category_id != $request->input('house_category_id')) {
        throw new \Exception("የተመረጠው ቤት ከተመረጠው የቤት ምድብ ውስጥ አይደለም");
    }

    // Check if the full name, gender, and recipient number match the selected bidder
    if (
        $bidder->full_name != $request->input('full_name') ||
        $bidder->gender != $request->input('gender') ||
        $bidder->full_name != $request->input('cpo_person_name') ||
        $bidder->recipient_number != $request->input('recipient_number')
    ) {
        throw new \Exception("በተዛመደ አለመመጣጠን ምክንያት የተጫራቹን ስም፣ ጾታ እና የተቀባይ ቁጥር ማዘመን አልተቻለም.");
    }

    $initialPricePerSquare = $selectedHouse->initial_price_per_square;
    $Housetotalarea = $selectedHouse->total_house_area;
    $expectedTotalPrice = $Housetotalarea *  $request->input('price_per_square');
    $expectedCPOAmount = 0.02 * $expectedTotalPrice;
    $reasons = [];

    // Compare price_per_square with selected house's initial_price_per_square
    if ($request->input('price_per_square') < $initialPricePerSquare) {
        $reasons[] = 'በእያንዳንዱ ካሬ ከቤቱ የመጀመሪያ ዋጋ በታች';
    }
    if ($request->input('price_per_square') == $initialPricePerSquare) {
        $reasons[] = 'በእያንዳንዱ ካሬ ከቤቱ የመጀመሪያ ዋጋ ጋር እኩል ነው።';
    }

    // Check if total_price is below the house total area
    if ($request->input('total_price') < $Housetotalarea) {
        $reasons[] = 'የጠቅላላ ዋጋ/ከሚጠበቀው በታች ';
    }

    // Check if CPO amount is below the expected value
    if ($request->input('cpo_amount') < $expectedCPOAmount) {
        $reasons[] = 'ከሚጠበቀው ዝቅተኛ CPO መጠን';
    }

    // Concatenate reasons using a loop
    $reason = implode('; ', $reasons);

    // Set status based on reasons
    $status = 'Disqualified'; // Default status

    // Check if the bidder meets any of the qualified conditions
    if (($request->input('price_per_square') > $initialPricePerSquare && $request->input('cpo_amount') == $expectedCPOAmount) || ($request->input('price_per_square') > $initialPricePerSquare && $request->input('cpo_amount') > $expectedCPOAmount)) {
        $status = 'Qualified';
    }

    // Update bidder information
    $bidder->fill($request->all() + [
        'total_price' => $totalPrice ?? null,
        'status' => $status,
        'reason' => $reason,
    ]);
    $bidder->updated_by = Auth::id(); // Set updated_by to the logged-in user
    $bidder->house_id = $selectedHouse->id;
    $bidder->total_price = $expectedTotalPrice;
    $bidder->save();

    // Detach the bidder from the house if they are already attached
    $selectedHouse->bidders()->detach($bidder->id);
    // Attach the bidder to the house in the pivot table
    $selectedHouse->bidders()->attach($bidder->id);

    DB::commit();

    // Assign rank after updating bidder information
    $this->assignRankForHouse($bidder->house_id);

    return redirect()->route('admin.housecategories')->with('success', 'የተጫራች መረጃ ዘምኗል.');
}

//     public function update(Request $request)
// {
//     $request->validate([
//         'is_disabled' => 'required',
//         // 'region' => 'required',
//         // 'sub_city' => 'required',
//         // 'wereda' => 'required',
//         // 'bidder_house_number' => 'required',
//         // 'id_number' => 'required',
//         // 'nationality' => 'required',
//         'house_category_id' => 'required',
//         'house_number' => 'required',
//         'price_per_square' => 'required',
//         'cpo_amount' => 'required',
//         'cpo_number' => 'required',
//         'cpo_Bank_branch' => 'required',
//         'cpo_Bank_name' => 'required',
//         'cpo_person_name' => 'required',
//         'cpo_Bank_account' => 'required',
//     ]);

//     DB::beginTransaction();

//     $bidder = Bidder::where('receipt_number', $request->input('receipt_number'))->first();
//     $selectedHouse = House::where('house_number', $request->input('house_number'))->first();

    // Check if the bidder has already updated their information for a different house
    $previousHouseId = $bidder->house_id ?? null;
    if ($previousHouseId && $previousHouseId != $selectedHouse->id) {
        throw new \Exception("ተጫራቾች ለተመሳሳይ ቤት መረጃን ብዙ ጊዜ ማዘመን ይችላሉ።");
    }

    // Check if the selected house belongs to the selected house category
    if ($selectedHouse->category_id != $request->input('house_category_id')) {
        throw new \Exception("የተመረጠው ቤት ከተመረጠው የቤት ምድብ ውስጥ አይደለም");
    }
            // Check if the full name, gender, and recipient number match the selected bidder
            if (
                $bidder->full_name != $request->input('full_name') ||
                $bidder->gender != $request->input('gender') ||
                $bidder->full_name != $request->input('cpo_person_name') ||
                $bidder->recipient_number != $request->input('recipient_number')
            ) {
                // throw new \Exception("Unable to update bidder's name, gender, and recipient number due to mismatch.");
                throw new \Exception("በተዛመደ አለመመጣጠን ምክንያት የተጫራቹን ስም፣ ጾታ እና የተቀባይ ቁጥር ማዘመን አልተቻለም.");
            }
    // Your existing logic for updating bidder information...
    $initialPricePerSquare = $selectedHouse->initial_price_per_square;
    $Housetotalarea = $selectedHouse->total_house_area;
    $expectedTotalPrice = $Housetotalarea *  $request->input('price_per_square');
    $expectedCPOAmount = 0.02 * $expectedTotalPrice;
    $expectedCPOAmountBasedOnTotalPrice = 0.02 * $request->input('total_price');
    $reasons = [];

    // Compare total_house_area with selected house's total_house_area
    // if ($request->input('total_house_area') < $selectedHouse->total_house_area) {
    //     $reasons[] = 'ከቤቱ አጠቃላይ ስፋት በታች';
    // }
    // if ($request->input('total_house_area') > $selectedHouse->total_house_area) {
    //     $reasons[] = 'ከቤቱ አጠቃላይ ስፋት በላይ';
    // }
    // Check if CPO amount is below the expected value based on total_price
    // if ($request->input('cpo_amount') < $expectedCPOAmountBasedOnTotalPrice) {
    //     $reasons[] = 'የ cpo መጠን / ከተጠበቀው ከተጠበቀው የስህተት አጠቃላይ ዋጋ በታች አርቲሜቲክ ስህተት';
    // }
    // if ($request->input('cpo_amount') > $expectedCPOAmountBasedOnTotalPrice) {
    //     $reasons[] = 'የ cpo መጠን / ከተጠበቀው የስህተት አጠቃላይ ዋጋ በላይ አርቲሜቲክ ስህተት';
    // }
    // Compare price_per_square with selected house's initial_price_per_square
    if ($request->input('price_per_square') < $initialPricePerSquare) {
        $reasons[] = 'በእያንዳንዱ ካሬ ከቤቱ የመጀመሪያ ዋጋ በታች';
    }
    if ($request->input('price_per_square') == $initialPricePerSquare) {
        $reasons[] = 'በእያንዳንዱ ካሬ ከቤቱ የመጀመሪያ ዋጋ ጋር እኩል ነው።';
    }

    // Calculate total price
    // $totalPrice = $request->input('price_per_square') * $selectedHouse->total_house_area;

    // Check if total_price is below or above the expected value
    if ($request->input('total_price') < $Housetotalarea) {
        $reasons[] = 'የጠቅላላ ዋጋ/ከሚጠበቀው በታች ያለው አርቲሜቲክ ስህተት';
    }
    if ($request->input('total_price') > $Housetotalarea) {
        $reasons[] = 'የጠቅላላ ዋጋ/ከሚጠበቀው በላይ አርቲሜቲክ ስህተት';
    }

    // Check if CPO amount is below the expected value
    if ($request->input('cpo_amount') < $expectedCPOAmount) {
        $reasons[] = 'ከሚጠበቀው ዝቅተኛ CPO መጠን';
    }
    if ($request->input('cpo_amount') > $expectedCPOAmount) {
        $reasons[] = 'የ cpo መጠን / ከተጠበቀው በላይ አርቲሜቲክ ስህተት';
    }

    // Concatenate reasons using a loop
    $reason = implode('; ', $reasons);

   // Set status based on reasons
$status = 'Disqualified'; // Default status

// Check if the bidder has all of the specified reasons exclusively
if (count($reasons) == 3 && 

    in_array("የጠቅላላ ዋጋ/ከሚጠበቀው በላይ አርቲሜቲክ ስህተት", $reasons) &&
    in_array("የ cpo መጠን / ከተጠበቀው በላይ አርቲሜቲክ ስህተት", $reasons)) {
    $status = 'Qualified';
}

// // Update bidder information
// $bidder->fill($request->all() + [
//     'total_price' => $totalPrice ?? null,
//     'status' => $status,
//     'reason' => $reason,
// ]);
// $bidder->updated_by = Auth::id(); // Set updated_by to the logged-in user
// $bidder->house_id = $selectedHouse->id;
// $bidder->save();

// // Detach the bidder from the house if they are already attached
// $selectedHouse->bidders()->detach($bidder->id);
//     // Attach the bidder to the house in the pivot table
//     $selectedHouse->bidders()->attach($bidder->id);

//     DB::commit();

//     // Assign rank after updating bidder information
//     $this->assignRankForHouse($bidder->house_id);

//     return redirect()->route('admin.housecategories')->with('success', 'የተጫራች መረጃ ዘምኗል.');
// }

    // public function update(Request $request)
    // {
    //     $request->validate([
    //         'is_disabled' => 'required',
    //         // 'region' => 'required',
    //         // 'sub_city' => 'required',
    //         // 'wereda' => 'required',
    //         // 'bidder_house_number' => 'required',
    //         // 'id_number' => 'required',
    //         // 'nationality' => 'required',
    //         'house_category_id' => 'required',
    //         'house_number' => 'required',
    //         'price_per_square' => 'required',
    //         'total_price' => 'required',
    //         'cpo_amount' => 'required',
    //         'cpo_number' => 'required',
    //         'cpo_Bank_branch' => 'required',
    //         'cpo_Bank_name' => 'required',
    //         'cpo_person_name' => 'required',
    //         'cpo_Bank_account' => 'required',
    //     ]);

    //     // try {
    //         DB::beginTransaction();

    //         $bidder = Bidder::where('receipt_number', $request->input('receipt_number'))->first();
    //         $selectedHouse = House::where('house_number', $request->input('house_number'))->first();
    //         // Check if the bidder has already updated their information for a different house
    //         $previousHouseId = $bidder->house_id ?? null;
    //         if ($previousHouseId && $previousHouseId != $selectedHouse->id) {
    //             // throw new \Exception("Bidder can only update information for the same house multiple times.");
    //             throw new \Exception("ተጫራቾች ለተመሳሳይ ቤት መረጃን ብዙ ጊዜ ማዘመን ይችላሉ።");
    //         }
    //         // Check if the selected house belongs to the selected house category
    //         // Assuming you have a category_id associated with each house
    //         if ($selectedHouse->category_id != $request->input('house_category_id')) {
    //             // throw new \Exception("The selected house does not belong to the selected house category.");
    //             throw new \Exception("የተመረጠው ቤት ከተመረጠው የቤት ምድብ ውስጥ አይደለም");
    //         }

    //         // Check if the full name, gender, and recipient number match the selected bidder
    //         // if (
    //         //     $bidder->full_name != $request->input('full_name') ||
    //         //     $bidder->gender != $request->input('gender') ||
    //         //     $bidder->full_name != $request->input('cpo_person_name') ||
    //         //     $bidder->recipient_number != $request->input('recipient_number')
    //         // ) {
    //         //     // throw new \Exception("Unable to update bidder's name, gender, and recipient number due to mismatch.");
    //         //     throw new \Exception("በተዛመደ አለመመጣጠን ምክንያት የተጫራቹን ስም፣ ጾታ እና የተቀባይ ቁጥር ማዘመን አልተቻለም.");
    //         // }

    //         // Your existing logic for updating bidder information...
    //         $initialPricePerSquare = $selectedHouse->initial_price_per_square;
    //         $Housetotalarea = $selectedHouse->total_house_area;
    //         $expectedTotalPrice = $Housetotalarea * $initialPricePerSquare;
    //         $expectedCPOAmount = 0.02 * $expectedTotalPrice;
    //         // Initialize an empty array to store reasons
    //         $reasons = [];

    //         // Compare total_house_area with selected house's total_house_area
    //         if ($request->input('total_house_area') < $selectedHouse->total_house_area) {
    //             $reasons[] = 'ከቤቱ አጠቃላይ ስፋት በታች';
    //         }
    //         if ($request->input('total_house_area') > $selectedHouse->total_house_area) {
    //             $reasons[] = 'ከቤቱ አጠቃላይ ስፋት በላይ';
    //         }

    //         // Compare price_per_square with selected house's initial_price_per_square
    //         if ($request->input('price_per_square') < $initialPricePerSquare) {
    //             $reasons[] = 'በእያንዳንዱ ካሬ ከቤቱ የመጀመሪያ ዋጋ በታች';
    //         }
    //         if ($request->input('price_per_square') == $initialPricePerSquare) {
    //             $reasons[] = 'በእያንዳንዱ ካሬ ከቤቱ የመጀመሪያ ዋጋ ጋር እኩል ነው።';
    //         }

    //         // Calculate total price
    //         $totalPrice = $request->input('price_per_square') * $selectedHouse->total_house_area;

    //         // Check if total_price is below or above the expected value
    //         if ($request->input('total_price') < $totalPrice) {
    //             $reasons[] = 'የጠቅላላ ዋጋ/ከሚጠበቀው በታች ያለው አርቲሜቲክ ስህተት';
    //         }
    //         if ($request->input('total_price') > $totalPrice) {
    //             $reasons[] = 'የጠቅላላ ዋጋ/ከሚጠበቀው በላይ አርቲሜቲክ ስህተት';
    //         }

    //         // Check if CPO amount is below the expected value
    //         if ($request->input('cpo_amount') < $expectedCPOAmount) {
    //             $reasons[] = 'ከሚጠበቀው ዝቅተኛ CPO መጠን';
    //         }
    //         if ($request->input('cpo_amount') > $expectedCPOAmount) {
    //             $reasons[] = 'የ cpo መጠን / ከተጠበቀው በላይ አርቲሜቲክ ስህተት';
    //         }

    //         // Concatenate reasons using a loop
    //         $reason = implode('; ', $reasons);
    //         // dd($reason);
    //         // Update bidder information
    //         $bidder->fill($request->all() + ['total_price' => $totalPrice ?? null]);
    //         $bidder->updated_by = Auth::id(); // Set updated_by to the logged-in user

    //       // Set status based on reasons
    //     $status = 'Qualified'; // Default status

    //     if (in_array("የ cpo መጠን / ከተጠበቀው በላይ አርቲሜቲክ ስህተት", $reasons) || in_array("የጠቅላላ ዋጋ/ከሚጠበቀው በላይ አርቲሜቲክ ስህተት", $reasons) || in_array("ከቤቱ አጠቃላይ ስፋት በላይ", $reasons)) {
    //         $status = 'Qualified';
    //     } elseif (!empty($reasons)) {
    //         $status = 'Disqualified';
    //     }

    //     // Update bidder information
    //     $bidder->fill($request->all() + [
    //         'total_price' => $totalPrice ?? null,
    //         'status' => $status,
    //         'reason' => $reason,
    //     ]);
    //         $bidder->house_id = $selectedHouse->id;
    //         $bidder->save();




    //         // Attach the bidder to the house in the pivot table
    //         $selectedHouse->bidders()->attach($bidder->id);

    //         DB::commit();

    //         // Assign rank after updating bidder information
    //         $this->assignRankForHouse($bidder->house_id);

    //         return redirect()->route('admin.housecategories')->with('success', 'የተጫራች መረጃ ዘምኗል.');
    //     // } catch (\Exception $e) {
    //     //     DB::rollBack();
    //     //     return redirect()->back()->with('error', $e->getMessage());
    //     // }
    // }

    public function searchReceiptNumbers(Request $request)
    {
        try {
            $search = $request->search;
            $receiptNumbers = Bidder::query()
                ->where('receipt_number', 'LIKE', "%{$search}%")
                ->pluck('receipt_number');

            return response()->json($receiptNumbers);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    // Method to get bidder details by receipt number
    public function getBidderInfo($receiptNumber)
    {
        $bidder = Bidder::where('receipt_number', $receiptNumber)->first();

        if (!$bidder) {
            return response()->json(['error' => 'Bidder not found'], 404);
        }

        return response()->json([
            'full_name' => $bidder->full_name,
            'gender' => $bidder->gender,
            'phone' => $bidder->phone,
        ]);
    }

    public function getBidderHouseInfo($houseNumber)
    {
        $house = House::where('house_number', $houseNumber)->first();

        if (!$house) {
            return response()->json(['error' => 'House not found'], 404);
        }

        return response()->json([
            'sub_city_wereda' => $house->sub_city_wereda,
            'site_name' => $house->site_name,
            'building_number' => $house->building_number,
            'floor_number' => $house->floor_number,
            'total_house_area' => $house->total_house_area,
            
        ]);
    }
    public function assignRankForHouse($houseId)
    {
        // Retrieve qualified bidders for the specified house ordered by total_price in descending order
        $bidders = Bidder::where('house_id', $houseId)
            ->where('status', 'Qualified')
            ->orderBy('total_price', 'desc')
            ->orderBy('is_disabled', 'desc')
            ->orderByRaw("CASE WHEN gender = 'ሴ' THEN 1 ELSE 2 END") // Prioritize female bidders
            ->get();

        // Initialize rank counter
        $rank = 0;

        // Initialize variables to track previous total price and disability status
        $previousTotalPrice = null;
        $previousIsDisabled = null;
        $previousGender = null;

        foreach ($bidders as $bidder) {
            // Increment the rank counter if the total_price, disability status, or gender changes
            if ($bidder->total_price !== $previousTotalPrice || $bidder->is_disabled !== $previousIsDisabled || $bidder->gender !== $previousGender) {
                $rank++;
            }

            // Update previous total price, disability status, and gender
            $previousTotalPrice = $bidder->total_price;
            $previousIsDisabled = $bidder->is_disabled;
            $previousGender = $bidder->gender;

            // Assign the rank to the bidder
            $bidder->rank = $rank;

            // Save the rank to the database
            $bidder->save();
        }
    }



    public function topBidders()
    {
        // Retrieve houses that have at least 3 qualified bidders
        $houses = House::whereHas('bidders', function ($query) {
            $query->where('status', 'Qualified');
        }, '>=', 1)
            ->with(['bidders' => function ($query) {
                $query->where('status', 'Qualified')
                    ->whereIn('rank', [1, 2, 3]) // Filter bidders with ranks 1, 2, and 3
                    ->orderBy('rank');
            }])
            ->get();

        // Render the Blade view to HTML
        return view('admin.bidders.top_bidders', compact('houses'))->render();
    }


    public function disqualifiedBidders()
    {
        $disqualifiedBidders = Bidder::where('status', 'Disqualified')->get();

        return view('admin.bidders.disqualified_bidders_system', compact('disqualifiedBidders'));
    }




    public function printTopBiddersForHouses()
    {
        // Retrieve houses that have at least 3 qualified bidders
        $houses = House::whereHas('bidders', function ($query) {
            $query->where('status', 'Qualified');
        }, '>=', 1)
            ->with(['bidders' => function ($query) {
                $query->where('status', 'Qualified')
                    ->whereIn('rank', [1, 2, 3]) // Filter bidders with ranks 1, 2, and 3
                    ->orderBy('rank');
            }])
            ->orderBy('site_name') // Order by site name
            ->orderBy('category_id') // Then order by category_id
            ->get();


        // Create a new instance of your custom class that extends TCPDF
        $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // Set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Your Name');
        $pdf->SetTitle('Top Bidders for Houses');
        $pdf->SetSubject('Top Bidders for Houses');
        $pdf->SetKeywords('TCPDF, PDF, top bidders, houses');

        // Set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // Set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT, true);

        // Set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // Add a page
        $pdf->AddPage('L', 'A4');

        // // Display the title for the top bidders section
        // $pdf->Ln(1); // Line break to provide some space after the header image
        // $pdf->SetFont('freeserif', '', 14);
        // $pdf->Cell(0, 10, 'የተጫራቾች ጊዚያዊ ውጤት (1-3)', 0, 1, 'C');

        // Initialize a variable to track current site
        $currentSite = null;
        // Initialize a variable to track houses per page
        $housesPerPage = 0;

        // Loop through each house
        foreach ($houses as $house) {
            // Check if the site has changed
            if ($house->site_name != $currentSite) {
                $currentSite = $house->site_name; // Update current site
                // Display the site name before listing the houses
                $pdf->Ln(5); // Add extra space before each site
                $pdf->SetFont('freeserif', '', 12);
                $pdf->Cell(50, 10, 'በ ' . $currentSite . ' ሳይት የሚገኙ የ' . $house->houseCategory->name, 0, 1, 'C');
            }

            // Display house number
            $pdf->Ln(5);
            $pdf->SetFont('freeserif', '', 12);
            $pdf->Cell(0, 10, 'የቤት ቁጥር: ' . $house->house_number, 0, 1, 'L');

            // Display bidders for the house in a table
            $pdf->SetFont('freeserif', '', 10);
            $pdf->Ln(2); // Line break to provide some space after the header image
            $pdf->Cell(0, 10, 'አሸናፊ ተጫራቾች', 0, 1, 'L');

            // Initialize HTML string for content
            $tableHtml = '<table cellspacing="0" cellpadding="4" border="1" style="width:100%;">
                    <thead>
                        <tr>
                            <th>ደረጃ</th>
                            <th>ሙሉ ስም</th>
                            <th>ጾታ</th>
                            <th>አካል ጉዳይ?</th>
                            <th>ጠቅላላ ዋጋ</th>
                            <th>የደረሰኝ ቁጥር</th>
                        </tr>
                    </thead>
                    <tbody>';

            foreach ($house->bidders as $bidder) {
                $tableHtml .= '<tr>
                        <td>' . $bidder->rank . '</td>
                        <td>' . $bidder->full_name . '</td>
                        <td>' . $bidder->gender . '</td>
                        <td>' . ($bidder->is_disabled ? 'Yes' : 'No') . '</td>
                        <td>' . $bidder->total_price . '</td>
                        <td>' . $bidder->receipt_number . '</td>
                    </tr>';
            }

            $tableHtml .= '</tbody></table>';

            // Output the HTML to the PDF
            $pdf->writeHTML($tableHtml, true, false, true, false, '');

            // Increment houses per page counter
            $housesPerPage++;

            // Check if 4 houses have been printed on the current page
            if ($housesPerPage > 4) {
                // Add a page break
                $pdf->AddPage('L', 'A4');
                // Reset houses per page counter
                $housesPerPage = 0;
            }
        }

        // Output the PDF to a browser
        $pdf->Output('top_bidders_for_houses.pdf', 'I');
    }
}
