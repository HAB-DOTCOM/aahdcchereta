@extends('layouts.admin')
@section('title', 'House and Bidders')

@section('content')
<div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">House Information</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <!-- Print button -->
                    <div class="text-right">
                        <a href= "{{route('printHouseAndBidders',$house->id)}}" class="btn btn-primary">Print</a>
                    </div>
                    <h5 class="card-title">የቤቱ መረጃ</h5>
                    <div class="house-info">
                        <div class="row">
                            <div class="col-md-4">
                                <p><strong>የቤቱ ምድብ:</strong> {{ $house->houseCategory->name }}</p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>የቤቱ ክፍለ ከተማ /ወረዳ :</strong> {{ $house->sub_city_wereda }}</p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>የቤቱ ሳይት:</strong> {{ $house->site_name }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <p><strong>የቤቱ ሕንፃ ቁጥር :</strong> {{ $house->building_number }}</p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>የቤቱ ቁጥር :</strong> {{ $house->house_number }}</p>
                            </div>
                            <div class="col-md-4">
                                <p><strong>የቤቱ ጠቅላላ ስፋት :</strong> {{ $house->total_house_area }}</p>
                            </div>
                        </div>
                        <p><strong>በካሬ መነሻ ዋጋ :</strong> {{ $house->initial_price_per_square }}</p>
                    </div>

                    <h5 class="card-title">የተጫራቾች ዝርዝር</h5>
                    <div class="table-responsive">
                        <table id="bidders-table" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ተ.ቁ.</th>
                                   
                                    <th style="width: 33.33%;">ስም</th>
                                <th style="width: 33.33%;">የአባት ስም</th>
                                <th style="width: 33.33%;">የአያት ስም</th>
                                    <th>ጾታ</th>
                                    <th>አካል ጉዳይ?</th>
                                    <th>መነሻ ዋጋ</th>
                                    <th>ደረጃ</th>
                                    <th>የደረሰኝ ቁጥር</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bidders as $key=>$bidder)
                                <tr>
                                <td>{{ $key+1 }}</td>
                          
                                    <td>{{ $bidder->first_name }}</td>
                                    <td>{{ $bidder->middle_name }}</td>
                                    <td>{{ $bidder->last_name }}</td>
                                    <td>{{ $bidder->gender }}</td>
                                    <td>{{ $bidder->is_disabled ? 'አዎ' : 'አይ' }}</td>
                                    <td>{{ $bidder->price_per_square }}</td>
                                    <td>
                                    @if ($bidder->rank === null)
                                        @if ($bidder->special_reason !== null)
                                            በኮሚቴ ውድቅ 
                                        @else
                                            በሲስተም ውድቅ
                                        @endif
                                    @else
                                        {{ $bidder->rank }}
                                    @endif
                                </td>
                                    <td>{{ $bidder->receipt_number }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

           
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
    <!-- Include DataTables JavaScript -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            $('#bidders-table').DataTable();
        });
    </script>
@endsection

@section('css')
    <!-- Include DataTables CSS -->
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection
