@extends('layouts.admin')
@section('title','አዲስ ውል ማዋዋያ')
@section('css')
@stop
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script>
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
                        <h5 class="m-b-10">አዲስ ውል ማዋዋያ</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">አዲስ ውል ማዋዋያ</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>አዲስ ውል ማዋዋያ</h5>
                @include('layouts.msg')
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('admin.createAgreement') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="receipt_number">የተጫራች የደረሰኝ ቁጥር</label>
                                <input type="text" name="receipt_number" required class="form-control" id="receipt_number" placeholder="የተጫራች የደረሰኝ ቁጥር">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="house_number">የቤት ቁጥር</label>
                                <input type="text" name="house_number" required class="form-control" id="house_number" placeholder="የሕንፃ ቁጥር">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="full_name">የተጫራች ሙሉ ስም</label>
                                <input type="text" name="full_name" required class="form-control" id="full_name" placeholder="የተጫራች ሙሉ ስም" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gender">የተጫራች ፆታ</label>
                                <input type="text" name="gender" required class="form-control" id="gender" placeholder="የተጫራች ፆታ" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone_number">የተጫራች ስልክ ቁጥር</label>
                                <input type="text" name="phone_number" required class="form-control" id="phone_number" placeholder="የተጫራች ስልክ ቁጥር" readonly>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sub_city_wereda">ክፍለ ከተማ / ወረዳ </label>
                                <input type="text" name="sub_city_wereda" required class="form-control" id="sub_city_wereda" placeholder="ክፍለ ከተማ / ወረዳ	" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="site_name">የሳይት ስም</label>
                                <input type="text" name="site_name" required class="form-control" id="site_name" placeholder="የሳይት ስም" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="building_number">የሕንፃ ቁጥር</label>
                                <input type="text" name="building_number" required class="form-control" id="building_number" placeholder="የሕንፃ ቁጥር" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="floor_number">የወለል ቁጥር</label>
                                <input type="text" name="floor_number" required class="form-control" id="floor_number" placeholder="የወለል ቁጥር" readonly>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">አስገባ</button>
                </form>
            </div>
        </div>
    </div>
</div>
@section('javascript')

@stop
@endsection