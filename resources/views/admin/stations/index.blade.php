@extends('layouts.admin')
@section('title','የምዝገባ ጣቢያዎች')
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
                        <h5 class="m-b-10">የምዝገባ ጣቢያዎች</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">የምዝገባ ጣቢያዎች</a></li>
                    </ul> <br> <br>
                    @can('station-create')
                    <a href="{{ route('admin.BidderStation.create') }}" class="btn btn-primary">አዲስ ለመጨመር</a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>የምዝገባ ጣቢያዎች</h5>
                    @include('layouts.msg')
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ተ.ቁ.</th>
                                    <th>ስም</th>
                                    <th>የመዘገበው</th>
                                    <th>ድንጊት</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($stations as $key=>$station)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $station->name }}</td>
                                    <td>{{ $station->user->first_name ?? '-' }}</td>
                                    <td>
                                        @can('station-edit')
                                        <a href="{{ route('admin.editBidderStation', $station->id) }}" class="btn btn-sm btn-success">ለአርትዖት</a>
                                        @endcan
                                        @can('station-view')
                                        <a href="{{ route('admin.showBidderStation', $station->id) }}" class="btn btn-sm btn-success">ለማየት</a>
                                        @endcan
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <p>ምንም አልተገኘም</p>
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