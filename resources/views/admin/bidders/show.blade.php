@extends('layouts.admin')
@section('title','የተጫራች ዝርዝር መረጃ')
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
                        <h5 class="m-b-10">የተጫራች ዝርዝር መረጃ</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">የተጫራች ዝርዝር መረጃ</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>የተጫራች ዝርዝር መረጃ</h5>
                @include('layouts.msg')
            </div>

            <div class="card-body">
                <form>
                    <h3 class="mt-2" id="bidder-info-title">የተጫራቾች የግል ዝርዝር መረጃዎች</h3>
                    <div id="bidder-info-form">
                        <div class="row ">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputState">ጣቢያ</label>
                                    <div class="alert alert-dark" role="alert">
                                        {{ $bidder->biider_station_id }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="receipt_number">የደረሰኝ ቁጥር</label>
                                    <div class="alert alert-dark" role="alert">
                                        {{ $bidder->receipt_number }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="full_name">ሙሉ ስም</label>
                                    <div class="alert alert-dark" role="alert">
                                        {{ $bidder->full_name }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">ስልክ ቁጥር</label>
                                    <div class="alert alert-dark" role="alert">
                                        {{ $bidder->phone }}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gender">ጾታ</label>
                                    <div class="alert alert-dark" role="alert">
                                        {{ $bidder->gender }}
                                    </div>
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