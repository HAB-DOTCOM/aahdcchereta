@extends('layouts.admin')
@section('title','Trashed Destinations')
@section('css')
<link rel="stylesheet" href="/Mayor/Admin/assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css" />
@stop
@section('content')

<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Trashed Destinations</h2>

                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button">
                        <i class="zmdi zmdi-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            @include('layouts.msg')
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Image</th>
                                            <th>Last Modified</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($destinations as $destination)
                                        <tr>
                                            <td>{{ $destination->name }}</td>
                                            <td><img class="img-responsive img-thumbnail" src="{{ asset('uploads/Destination/'.$destination->icon) }}" style="height: 100px; width: 100px" alt=""></td>
                                            <td>{{ Carbon\Carbon::parse($destination->updated_at)->format('F d, Y') }}</td>
                                            <td>
                                                <form class="form-update" method="post" action="{{ route('admin.restoreDestination', $destination->id) }}">
                                                    @method('patch')
                                                    @csrf
                                                    <button type="submit" onclick="this.form.submit()" class="btn btn-sm btn-success">
                                                        <i class="zmdi zmdi-refresh-alt"></i></a>
                                                    </button>
                                                </form>
                                                <form id="delete-form-{{ $destination->id }}" action="{{ route('admin.deleteDestinationPermanent',$destination->id) }}" style="display: none;" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure? You want to delete this?')){
                                                    event.preventDefault();
                                                    document.getElementById('delete-form-{{ $destination->id }}').submit();
                                                }else {
                                                    event.preventDefault();
                                                        }"><i class="zmdi zmdi-delete"></i></button>
                                            </td>
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
    </div>
</section>
@section('javascript')
<script src="/Mayor/Admin/assets/bundles/libscripts.bundle.js"></script>
<script src="/Mayor/Admin/assets/bundles/vendorscripts.bundle.js"></script>
<script src="/Mayor/Admin/assets/bundles/datatablescripts.bundle.js"></script>
<script src="/Mayor/Admin/assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="/Mayor/Admin/assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
<script src="/Mayor/Admin/assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js"></script>
<script src="/Mayor/Admin/assets/plugins/jquery-datatable/buttons/buttons.flash.min.js"></script>
<script src="/Mayor/Admin/assets/plugins/jquery-datatable/buttons/buttons.html5.min.js"></script>
<script src="/Mayor/Admin/assets/plugins/jquery-datatable/buttons/buttons.print.min.js"></script>
<script src="/Mayor/Admin/assets/bundles/mainscripts.bundle.js"></script>
<script src="/Mayor/Admin/assets/js/pages/tables/jquery-datatable.js"></script>

@stop
@endsection