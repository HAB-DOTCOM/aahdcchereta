@extends('layouts.admin')
@section('title','ቤቶች')
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
                        <h5 class="m-b-10">ቤቶች</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">ቤቶች</a></li>
                    </ul> <br> <br>
                    @can('houses-create')
                    <a href="{{ route('admin.housecategory.create') }}" class="btn  btn-primary">አዲስ ለመዝገብ</a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>ቤቶች</h5>
                    @include('layouts.msg')
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive table-bordered">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ተ.ቁ.</th>
                                    <th>የሕንፃ ቁጥር</th>
                                    <th>ክፍለ ከተማ / ወረዳ</th>
                                    <th>የሳይት ስም</th>
                                    <th>የቤት ቁጥር</th>
                                    <th>ድርጊት</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($houses as $key=>$house)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $house->building_number }}</td>
                                    <td>{{ $house->sub_city_wereda }}</td>
                                    <td>{{ $house->site_name }}</td>
                                    <td>{{ $house->house_number }}</td>
                                    <td>
                                        @can('houses-create')
                                        <a href="{{ route('admin.updateHouse', $house->id) }}" class="btn btn-sm btn-success">Edit</a>
                                        @endcan
                                        @can('houses-view')
                                        <a href="{{ route('admin.showHouse', $house->id) }}" class="btn btn-sm btn-success">Show</a>
                                        @endcan
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
                            {{ $houses->links('pagination::bootstrap-4') }}
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