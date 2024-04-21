@extends('layouts.admin')
@section('title','አጠቃላይ የቤት ተጫራቾች ማዘመኛ')
@section('css')
@stop
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">አጠቃላይ የቤት ተጫራቾች ማዘመኛ</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">አጠቃላይ የቤት ተጫራቾች ማዘመኛ</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>አጠቃላይ የቤት ተጫራቾች ማዘመኛ</h5>
                @include('layouts.msg')
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('bidders.assignRankForHouseBidders') }}">
                    @csrf
                    <h3 class="mt-2" id="bidder-info-title">አጠቃላይ የቤት ተጫራቾች ማዘመኛ</h3>
                    <div id="bidder-info-form">
                        <div class="row ">
             
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="house_number">የቤት ቁጥር</label>
                                    <input type="text" name="house_number" id="house_number" class="form-control" placeholder="የቤት ቁጥር">
                                </div>
                            </div>
                            
                        </div>

                        <button type="submit" class="btn btn-primary">አስገባ</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')



@stop