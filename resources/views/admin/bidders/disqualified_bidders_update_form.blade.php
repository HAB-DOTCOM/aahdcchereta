@extends('layouts.admin')

@section('title', 'Update Bidders')

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
                        $('input[name="cpo_person_name"]').val(data.full_name);
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
                        <h5 class="m-b-10">Update Bidders</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">Update Bidders</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Add New Bidder</h5>
                @include('layouts.msg')
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('admin.specialdisqualifiedbidders.update.details') }}">
                    @csrf
                    <!-- Update Bidders Personal Information -->
                    <h3 class="mt-2" id="bidder-info-title">የተጫራቹን የግል መረጃ ያዘምኑ &nbsp;<i class="fa-solid fa-angles-left fa-fade"></i></h3>
                    <div id="bidder-info-form" style="display: none;">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="receipt_number">Receipt Number</label>
                                    <input type="text" name="receipt_number" id="receipt_number" class="form-control" placeholder="Search Receipt Number">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="full_name">Full Name</label>
                                    <input type="text" name="full_name" id="full_name" class="form-control" placeholder="Full Name" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Phone NUmber</label>
                                    <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="Phone Number" readonly>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gender">Gender</label>
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
                                    <label for="pox">P.O.X</label>
                                    <input type="text" name="pox" id="pox" class="form-control" placeholder="pox">
                                </div>
                            </div> -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="is_disabled">Is Disable</label>
                                    <select name="is_disabled" id="is_disabled" class="form-control custom-select">
                                        <option selected>Choose...</option>
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_number">ID Number</label>
                                    <input type="text" name="id_number" id="id_number" class="form-control" placeholder="id_number">
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
                    <h3 class="mt-5" id="bidder-house-title">የተጫራቹን የቤት መረጃ ያዘምኑ &nbsp;<i class="fa-solid fa-angles-left fa-fade"></i></h3>
                    <div id="bidder-house-form" style="display: none;">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="house_category_id">House Category</label>
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
                                    <label for="full_name">House Number</label>
                                    <input type="text" name="house_number" id="house_number" class="form-control" placeholder="house_number">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sub_city_wereda">Sub City</label>
                                    <input type="text" name="sub_city_wereda" id="sub_city_wereda" class="form-control" placeholder="sub_city_wereda" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="site_name">Site Name</label>
                                    <input type="text" name="site_name" id="site_name" class="form-control" placeholder="site_name" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="building_number">Building Number</label>
                                    <input type="text" name="building_number" id="building_number" class="form-control" placeholder="building_number" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="floor_number">Floor Number</label>
                                    <input type="text" name="floor_number" id="floor_number" class="form-control" placeholder="Floor Number" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="total_house_area">Total Area</label>
                                    <input type="text" name="total_house_area" id="total_house_area" class="form-control" placeholder="Total House Area">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price_per_square">Price Per Square Metere</label>
                                    <input type="number" name="price_per_square" id="price_per_square" class="form-control" placeholder="price_per_square" min=0>
                                </div>
                                <div id="priceInWords"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="total_price">Total Price </label>
                                    <input type="text" name="total_price" id="total_price" class="form-control" placeholder="total_price">
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Update Bidders CPO Information -->
                    <h5 class="mt-5" id="bidder-cpo-title">የተጫራቹን የባንክ መረጃዎች ያዘምኑ &nbsp;<i class="fa-solid fa-angles-left fa-fade"></i></h5>
                        <div id="bidder-cpo-form" style="display: none;">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cpo_Bank_name">የባንክ ስም</label>
                                        <input type="text" name="cpo_Bank_name" id="cpo_Bank_name" class="form-control" placeholder="የባንክ ስም">
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

                    <!-- Reason for Disqualification -->
                    <div class="form-group mt-5">
                        <label for="special_reason">Reason for Disqualification</label>
                        <textarea class="form-control" id="special_reason" name="special_reason" rows="3"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
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