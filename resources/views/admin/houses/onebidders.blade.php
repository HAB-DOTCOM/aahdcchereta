@extends('layouts.admin')
@section('title','ቤቶች')
@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
<style>
        /* Custom styling for DataTables */
        #bidders-table_wrapper .dataTables_length,
        #bidders-table_wrapper .dataTables_filter {
            margin-bottom: 10px;
            text-align: right;
        }

        #bidders-table_paginate {
            display: none; /* Hide DataTable pagination */
        }
    </style>
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
                   
                    <a href="{{ route('admin.houses') }}" class="btn  btn-primary">ተመለስ</a>
                   
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
                        <table id="datatable" class="table">
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
                                @forelse($housesWithOneBidder as $key=>$house)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $house->building_number }}</td>
                                    <td>{{ $house->sub_city_wereda }}</td>
                                    <td>{{ $house->site_name }}</td>
                                    <td>{{ $house->house_number }}</td>
                                    <td>
                                        @can('houses-create')
                                        <a href="{{ route('admin.updateHouse', $house->id) }}" class="btn btn-sm btn-success">ለአርትዖት</a>
                                        @endcan
                                        @can('houses-view')
                                        <a href="{{ route('admin.showHouse', $house->id) }}" class="btn btn-sm btn-success">ለማየት</a>
                                        @endcan
                                        <!-- Add a link for getting all bidders of the house -->
                                        <a href="{{ route('admin.getHouseBidders', $house->id) }}" class="btn btn-sm btn-info">ተጫራቾችን ተመልከት</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6">ምንም አልተገኘም።</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                 
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                            {{ $housesWithOneBidder->links('pagination::bootstrap-4') }}
                        </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function() {
        $('.table').DataTable();
    });
</script>
@stop
