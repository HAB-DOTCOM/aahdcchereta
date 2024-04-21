@extends('layouts.admin')
@section('title','የቤቶች ምድቦች')
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
                        <h5 class="m-b-10">የቤቶች ምድቦች</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">የቤቶች ምድቦች</a></li>
                    </ul> <br> <br>
                    <a href="{{ route('admin.housecategory.create') }}" class="btn  btn-primary">አዲስ ለመመዝገብ</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>የቤቶች ምድቦች</h5>
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
                                    <th>ድርጊት</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($housecategories as $key=>$category)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->user->first_name ?? '-' }}</td>
                                    <td>
                                        @can('bidders-edit')
                                        <a href="{{ route('admin.editHouseCategory', $category->id) }}" class="btn btn-sm btn-success">ለአርትዖት</a>
                                        @endcan
                                        @can('bidders-view')
                                        <a href="{{ route('admin.showHouseCategory', $category->id) }}" class="btn btn-sm btn-success">ለማየት</a>
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
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@section('javascript')

@stop
@endsection