@extends('layouts.admin')

@section('title', 'በኮሚቴ ውድቅ የተደረጉ ተጫራቾችን ማዘመኛ')

@section('css')
@stop

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script>
    $(document).ready(function() {

    });
</script>
<script>
    $(document).ready(function() {
        console.log("JavaScript file loaded.");
        console.log("Document is ready.");
        $("#bidder-info-title").click(function() {
            console.log("Title clicked!");
            $("#bidder-info-form").toggle();
            console.log("Form visibility:", $("#bidder-info-form").is(":visible")); // Check form visibility
        });

        $("#bidder-house-title").click(function() {
            console.log("Title clicked!");
            $("#bidder-house-form").toggle();
            console.log("Form visibility:", $("#bidder-house-form").is(":visible")); // Check form visibility
        });

        $("#bidder-cpo-title").click(function() {
            console.log("Title clicked!");
            $("#bidder-cpo-form").toggle();
            console.log("Form visibility:", $("#bidder-house-form").is(":visible")); // Check form visibility
        });
    });
    $(function() {
        $("#house_number").on('change', function() {
            console.log("Change event triggered!"); // Log a message when the change event is triggered
            var houseNumber = $(this).val();
            console.log(houseNumber);
            if (houseNumber) {
                // Fetch and fill the bidder details
                fetchBidderHouseDetails(houseNumber);
            }
        });

        function fetchBidderHouseDetails(houseNumber) {
            console.log("Fetching bidder details for house number:", houseNumber); // Log the house number being fetched
            $.ajax({
                url: `/api/bidders/house/info/${houseNumber}`,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (!data.error) {
                        $('input[name="sub_city_wereda"]').val(data.sub_city_wereda);
                        $('input[name="site_name"]').val(data.site_name);
                        $('input[name="building_number"]').val(data.building_number);
                        $('input[name="total_house_area"]').val(data.total_house_area);
                        $('input[name="floor_number"]').val(data.floor_number);
                        // $('input[name="total_house_area"]').val(data.total_house_area);
                    } else {
                        console.log(data.error);
                        // Optionally clear the fields or show an error message
                    }
                }
            });
        }
    });
    $(function() {
        $("#receipt_number").on('change', function() {
            var receiptNumber = $(this).val();
            if (receiptNumber) {
                // Fetch and fill the bidder details
                fetchBidderDetails(receiptNumber);
            }
        });

        function fetchBidderDetails(receiptNumber) {
            $.ajax({
                url: `/api/bidders/info/${receiptNumber}`,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (!data.error) {
                        $('input[name="full_name"]').val(data.full_name);
                        $('input[name="first_name"]').val(data.first_name);
                        $('input[name="middle_name"]').val(data.middle_name);
                        $('input[name="last_name"]').val(data.last_name);
                        $('input[name="cpo_person_name"]').val(data.first_name + ' ' + data.middle_name + ' ' + data.last_name);
                        $('input[name="gender"]').val(data.gender);
                        $('input[name="phone_number"]').val(data.phone);
                    } else {
                        console.log(data.error);
                        // Optionally clear the fields or show an error message
                    }
                }
            });
        }
    });
</script>

<div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">በኮሚቴ ውድቅ የተደረጉ ተጫራቾችን ማዘመኛ</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">በኮሚቴ ውድቅ የተደረጉ ተጫራቾችን ማዘመኛ</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>በኮሚቴ ውድቅ የተደረጉ ተጫራቾችን ማዘመኛ</h5>
                @include('layouts.msg')
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('admin.disupdate',$bidder->id) }}">
                    @csrf
                    <!-- Update Bidders Personal Information -->
                    <h5 class="mt-2" id="bidder-info-title">የተጫራቹን የግል መረጃ ያዘምኑ &nbsp;<i class="fa-solid fa-angles-left fa-fade"></i></h3>
                        <div id="bidder-info-form" style="display: none;">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="receipt_number">የደረሰኝ ቁጥር</label>
                                        <input type="text" name="receipt_number" id="receipt_number" class="form-control" placeholder="Search Receipt Number">
                                    </div>
                                </div>
                                <input type="hidden" name="bidder_id" value="{{ $bidder->id }}">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="full_name">ስም</label>
                                        <input type="text" name="first_name" id="first_name" class="form-control" placeholder="ስም" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="middle_name">የአባት ስም</label>
                                        <input type="text" name="middle_name" id="middle_name" class="form-control" placeholder="የአባት ስም" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_name">የአያት ስም</label>
                                        <input type="text" name="last_name" id="last_name" class="form-control" placeholder="የአያት ስም" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">ስልክ ቁጥር</label>
                                        <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="Phone Number" readonly>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender">ጾታ</label>
                                        <input type="text" name="gender" id="gender" class="form-control" placeholder="Gender" readonly>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="region">Region</label>
                                    <input type="text" name="region" id="region" class="form-control" placeholder="region">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sub_city">Subcity/ Zone</label>
                                    <input type="text" name="sub_city" id="sub_city" class="form-control" placeholder="sub_city">
                                </div>
                            </div>
                        </div> -->
                            <!-- <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="bidder_house_number">House Number</label>
                                    <input type="text" name="bidder_house_number" id="house_number2" class="form-control" placeholder="Bidder House NUmber">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="office_phone">Office Phone NUmber</label>
                                    <input type="text" name="office_phone" id="office_phone" class="form-control" placeholder="office_phone">
                                </div>
                            </div>
                        </div> -->
                            <!-- <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="house_phone">House Phone NUmber</label>
                                    <input type="text" name="house_phone" id="house_phone" class="form-control" placeholder="house_phone">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="age">Age</label>
                                    <input type="text" name="age" id="age" class="form-control" placeholder="Age">
                                </div>
                            </div>
                        </div> -->
                            <div class="row">
                                <!-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pox">ፖ.ሳ.ቁ</label>
                                        <input type="text" name="pox" id="pox" class="form-control" placeholder="ፖ.ሳ.ቁ">
                                    </div>
                                </div> -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="is_disabled">አካል ጉዳት አለው??</label>
                                        <select name="is_disabled" id="is_disabled" class="form-control custom-select">
                                            <option selected>ምረጥ...</option>
                                            <option value="1">አዎ</option>
                                            <option value="0">አይ</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="id_number">የመታወቂያ ቁጥር</label>
                                        <input type="text" name="id_number" id="id_number" class="form-control" placeholder="የመታወቂያ ቁጥር">
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nationality">Nationality</label>
                                    <input type="text" name="nationality" id="nationality" class="form-control" placeholder="nationality">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="is_disabled">Is Disable</label>
                                    <select name="is_disabled" id="is_disabled" class="form-control custom-select">
                                        <option selected>Choose...</option>
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                            </div>
                                    <div class="col-md-3">
                            <div class="form-group">
                                <label for="wereda">Phone NUmber</label>
                                <input type="text" name="wereda" id="wereda" class="form-control" placeholder="wereda">
                            </div>
                         </div>
                        </div> -->
                        </div>

                        <!-- Update Bidders House Information -->
                        <h5 class="mt-5" id="bidder-house-title">የተጫራቹን የቤት መረጃ ያዘምኑ &nbsp;<i class="fa-solid fa-angles-left fa-fade"></i></h5>
                        <div id="bidder-house-form" style="display: none;">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="house_category_id">የቤት ምድብ</label>
                                        <select name="house_category_id" id="house_category_id" class="form-control custom-select">
                                            <option selected>Select Category</option>
                                            @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="full_name">የቤት ቁጥር</label>
                                        <input type="text" name="house_number" id="house_number" class="form-control" placeholder="የቤት ቁጥር">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sub_city_wereda">ክፍለ ከተማ / ወረዳ</label>
                                        <input type="text" name="sub_city_wereda" id="sub_city_wereda" class="form-control" placeholder="ክፍለ ከተማ / ወረዳ" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="site_name">የቤት ሳይት / ቦታ ስም</label>
                                        <input type="text" name="site_name" id="site_name" class="form-control" placeholder="የቤት ሳይት / ቦታ ስም" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="building_number">የሕንፃ ቁጥር</label>
                                        <input type="text" name="building_number" id="building_number" class="form-control" placeholder="የሕንፃ ቁጥር" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="floor_number">የወለል ቁጥር</label>
                                        <input type="text" name="floor_number" id="floor_number" class="form-control" placeholder="የወለል ቁጥር" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="total_house_area">ጠቅላላ የቤት ስፋት በካሬ</label>
                                        <input type="text" name="total_house_area" id="total_house_area" class="form-control" placeholder="ጠቅላላ የቤት ስፋት በካሬ" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="price_per_square">ዋጋ በካሬ ሜትር</label>
                                        <input type="number" name="price_per_square" id="price_per_square" class="form-control" placeholder="ዋጋ በካሬ ሜትር" min=0>
                                    </div>
                                    <div id="priceInWords"></div>
                                </div>
                            </div>
                            <!-- <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="total_price">Total Price </label>
                                    <input type="text" name="total_price" id="total_price" class="form-control" placeholder="total_price">
                                </div>
                            </div>

                        </div> -->
                        </div>

                        <!-- Update Bidders CPO Information -->
                        <h5 class="mt-5" id="bidder-cpo-title">የተጫራቹን የባንክ መረጃዎች ያዘምኑ &nbsp;<i class="fa-solid fa-angles-left fa-fade"></i></h5>
                        <div id="bidder-cpo-form" style="display: none;">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cpo_Bank_name">የባንክ ስም??</label>
                                        <select name="cpo_Bank_name" id="cpo_Bank_name" class="form-control custom-select">
                                            <option selected>ምረጥ...</option>
                                            <option value="abay_bank">Abay Bank</option>
                                            <option value="addis_international_bank">Addis International Bank</option>
                                            <option value="ahadu_bank">Ahadu Bank</option>
                                            <option value="amhara_bank">Amhara Bank</option>
                                            <option value="awash_bank">Awash Bank</option>
                                            <option value="bank_of_abyssinia">Bank of Abyssinia</option>
                                            <option value="berhan_bank">Berhan Bank</option>
                                            <option value="bunna_bank">Bunna Bank</option>
                                            <option value="cbe">Commercial Bank of Ethiopia (CBE)</option>
                                            <option value="cooperative_bank_of_oromia">Cooperative Bank of Oromia</option>
                                            <option value="dashen_bank">Dashen Bank</option>
                                            <option value="enat_bank">Enat Bank</option>
                                            <option value="global_bank_ethiopia">Global Bank Ethiopia</option>
                                            <option value="gadaa_bank">Gadaa Bank</option>
                                            <option value="hibret_bank">Hibret Bank</option>
                                            <option value="lion_bank">Lion Bank</option>
                                            <option value="hijra_bank">Hijra Bank</option>
                                            <option value="oromia_bank">Oromia Bank</option>
                                            <option value="nib_bank">Nib Bank</option>
                                            <option value="siinqee_bank">Siinqee Bank</option>
                                            <option value="shabelle_bank">Shabelle Bank</option>
                                            <option value="tsehay_bank">Tsehay Bank</option>
                                            <option value="tsedey_bank">Tsedey Bank</option>
                                            <option value="zamzam_bank">ZamZam Bank</option>
                                            <option value="wegagen_bank">Wegagen Bank</option>
                                            <option value="zemen_bank">Zemen Bank</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cpo_Bank_branch">የባንክ ቅርንጫፍ</label>
                                        <input type="text" name="cpo_Bank_branch" id="cpo_Bank_branch" class="form-control" placeholder="የባንክ ቅርንጫፍ">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cpo_Bank_name">የባንክ አካውንት ቁጥር</label>
                                        <input type="text" name="cpo_Bank_account" id="cpo_Bank_account" class="form-control" placeholder="የባንክ አካውንት ቁጥር">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cpo_Bank_branch">የ ሲፒኦ ባለቤት ስም</label>
                                        <input type="text" name="cpo_person_name" id="cpo_person_name" class="form-control" placeholder="የ ሲፒኦ ባለቤት ስም" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cpo_number">ሲፒኦ ቁጥር</label>
                                        <input type="text" name="cpo_number" id="cpo_number" class="form-control" placeholder="ሲፒኦ ቁጥር">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cpo_amount">ሲፒኦ መጠን</label>
                                        <input type="text" name="cpo_amount" id="cpo_amount" class="form-control" placeholder="ሲፒኦ መጠን">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-5">
    <label for="special_reason">ተጫራቹ ውድቅ የሆነበት ምክንያት</label>
    <textarea class="form-control" id="special_reason" name="special_reason" rows="3">{{ old('special_reason', $bidder->special_reason) }}</textarea>
</div>


                        <button type="submit" class="btn btn-primary">አዘመን</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>
    // Your JavaScript code here
</script>
@stop