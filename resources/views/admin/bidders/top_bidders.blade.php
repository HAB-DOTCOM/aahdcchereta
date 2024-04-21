@extends('layouts.admin')
@section('title', 'ከፍተኛ ተጫራቾች')
@section('css')
@stop
@section('content')
<div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">ከፍተኛ ተጫራቾች</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">ከፍተኛ ተጫራቾች</a></li>
                    </ul> <br> <br>
                    <a href="{{ route('print.results') }}" class="btn  btn-primary">አትም</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>ከፍተኛ ተጫራቾች (1-3 ደረጃ)</h5>
                    @include('layouts.msg')
                </div>
                <div class="card-body table-border-style">

                    <div class="table-responsive table-bordered">

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>የቤት ቁጥር</th>
                                    <th>አሸናፊ ተጫራቾች</th>
                                    <!-- <th>ድርጊት</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($houses as $house)
                                <tr>
                                    <td>{{ $house->house_number }}</td>
                                    <td>
                                        <table class="table">
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
                                            <tbody>
                                                @foreach($house->bidders->take(10) as $bidder)
                                                <tr>
                                                    <td>{{ $bidder->rank }}</td>
                                                    <td>{{ $bidder->full_name }}</td>
                                                    <td>{{ $bidder->gender }}</td>
                                                    <td>{{ $bidder->is_disabled ? 'Yes' : 'No' }}</td>
                                                    <td>{{ $bidder->total_price }}</td>
                                                    <td>{{ $bidder->receipt_number }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </td>
                                    <!-- <td>
                                        <a href="" class="btn btn-sm btn-success">Edit</a>
                                        <a href="" class="btn btn-sm btn-success">Show</a>
                                    </td> -->
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
@section('javascript')
@stop
@endsection