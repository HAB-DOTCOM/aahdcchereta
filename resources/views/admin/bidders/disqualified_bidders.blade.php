@extends('layouts.admin')
@section('title', 'ብቁ ያልሆኑ ተጫራቶች')
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
                        <h5 class="m-b-10">ብቁ ያልሆኑ ተጫራቶች</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">ብቁ ያልሆኑ ተጫራቶች</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>ብቁ ያልሆኑ ተጫራቶች</h5>
                    @include('layouts.msg')
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive table-bordered">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ተ.ቁ.</th>
                                    <th>ስም</th>
                                    <th>የደረሰኝ ቁጥር</th>
                                    <th>የተጫረቱበት የቤት ቁጥር</th>
                                    <th>ብቁ ያልሆነበት ምክንያት</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($specialReasonBidders as $key=>$bidder)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $bidder->full_name }}</td>
                                    <td>{{ $bidder->receipt_number }}</td>
                                    <td>
                                        @foreach($bidder->houses as $house)
                                        {{ $house->house_number }}<br>
                                        @endforeach
                                    </td>
                                    <td>{{ $bidder->special_reason  }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <p>ምንም አልተገኘም።</p>
                                </tr>

                                @endforelse
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