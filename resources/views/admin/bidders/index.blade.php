@extends('layouts.admin')
@section('title','ተጫራቾች')
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
                        <h5 class="m-b-10">ተጫራቾች</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">ተጫራቾች</a></li>
                    </ul> <br> <br>
                    <a href="{{ route('bidders.create') }}" class="btn  btn-primary">አዲስ ለመመዝገብ</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>ተጫራቾች</h5>
                    @include('layouts.msg')
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive table-bordered">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ተ.ቁ.</th>
                                    <th>ሙሉ ስም</th>
                                    <th>ጾታ</th>
                                    <th>ደረሰኝ ቁጥር</th>
                                    <th>ጣቢያ</th>
                                    <th>ድርጊት</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bidders as $key=>$bidder)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $bidder->full_name }}</td>
                                    <td>{{ $bidder->gender }}</td>
                                    <td>{{ $bidder->receipt_number }}</td>
                                    <td>{{ $bidder->station->name }}</td>
                                    <td>
                                        <a href="{{ route('bidders.edit', $bidder->id) }}" class="btn btn-sm btn-success">ለአርትዖት</a>
                                        <a href="{{ route('bidders.show', $bidder->id) }}" class="btn btn-sm btn-success">ለማየት</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <p>ምንም አልተገኘም።</p>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $bidders->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@section('javascript')

@stop
@endsection