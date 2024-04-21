@extends('layouts.admin')
@section('title','የተጫራች መረጃ ማስተካከያ')
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
                        <h5 class="m-b-10">የተጫራች መረጃ ማስተካከያ</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">የተጫራች መረጃ ማስተካከያ</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>የተጫራች መረጃ ማስተካከያ</h5>
                @include('layouts.msg')
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('bidders.store', $bidder->id) }}">
                    @csrf
                    <h3 class="mt-2" id="bidder-info-title">የተጫራች የግል መረጃዎችን ያርትዑ</h3>
                    <div id="bidder-info-form">
                        <div class="row ">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputState">ጣቢያ</label>
                                    <select name="biider_station_id" id="inputState" class="form-control">
                                        <option selected>ጣቢያ ምረጥ</option>
                                        @foreach($stations as $category)
                                        <option {{ $category->id == $bidder->biider_station_id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="receipt_number">የደረሰኝ ቁጥር</label>
                                    <input type="text" name="receipt_number" value="{{ $bidder->receipt_number }}" id="receipt_number" class="form-control" placeholder="የደረሰኝ ቁጥር">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="full_name">ሙሉ ስም</label>
                                    <input type="text" name="full_name" value="{{ $bidder->full_name }}" id="full_name" class="form-control" placeholder="ሙሉ ስም">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">ስልክ ቁጥር</label>
                                    <input type="text" name="phone" value="{{ $bidder->phone }}" id="phone_number" class="form-control" placeholder="ስልክ ቁጥር">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gender">ጾታ</label>
                                    <select name="gender" id="gender" class="form-control custom-select">
                                        <option selected>ጾታን ይምረጡ</option>
                                        <option {{ $bidder->gender == 'Male' ? 'selected' : '' }} value="Male">ወንድ</option>
                                        <option {{ $bidder->gender == 'Female' ? 'selected' : '' }} value="Female">ሴት</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">አዘምን</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')



@stop