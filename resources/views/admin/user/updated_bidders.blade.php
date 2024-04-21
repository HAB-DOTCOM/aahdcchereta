@extends('layouts.admin')
@section('title', 'Updated Bidders')

@section('content')
<div class="pcoded-content">
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">በተጠቃሚው የዘመኑ ተጫራቾች ዝርዝር</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Display date and count of updated bidders above the table -->
    <div class="row">
        <div class="col-md-12">
            @foreach ($updatedBiddersByDate as $date => $bidders)
                <div class="alert alert-primary" role="alert">
                    <strong>Date: {{ $date }}</strong> - Updated Bidders Count: {{ $bidders->count() }}
                </div>
                <div class="table-responsive">
                    <table id="bidders-table-{{ $loop->index }}" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ተ.ቁ.</th>
                                <th>ስም</th>
                                <th>የአባት ስም</th>
                                <th>የአያት ስም</th>
                                <th>ጾታ</th>
                                <th>አካል ጉዳይ?</th>
                                <th>መነሻ ዋጋ</th>
                                <th>የደረሰኝ ቁጥር</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bidders as $key => $bidder)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $bidder->first_name }}</td>
                                    <td>{{ $bidder->middle_name }}</td>
                                    <td>{{ $bidder->last_name }}</td>
                                    <td>{{ $bidder->gender }}</td>
                                    <td>{{ $bidder->is_disabled ? 'አዎ' : 'አይ' }}</td>
                                    <td>{{ $bidder->price_per_square }}</td>
                                    <td>{{ $bidder->receipt_number }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('javascript')
<!-- Include DataTables JavaScript -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize DataTable for each table
        @foreach ($updatedBiddersByDate as $date => $bidders)
            $('#bidders-table-{{ $loop->index }}').DataTable();
        @endforeach
    });
</script>
@endsection

@section('css')
<!-- Include DataTables CSS -->
<link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection
