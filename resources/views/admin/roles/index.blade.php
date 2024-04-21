@extends('layouts.admin')
@section('title','ሚናዎች')
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
                        <h5 class="m-b-10">ሚናዎች</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">ሚናዎች</a></li>
                    </ul> <br> <br>
                    @can('role-create')
                    <a href="{{ route('roles.create') }}" class="btn  btn-primary">አዲስ ለመጨመር</a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>ሚናዎች</h5>
                    @include('layouts.msg')
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ተ.ቁ.</th>
                                    <th>ስም</th>
                                    <th>ድርጊት</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $key => $role)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-success" href="{{ route('roles.show',$role->id) }}">ለማየት</a>
                                        @can('role-edit')
                                        <a class="btn btn-sm btn-success" href="{{ route('roles.edit',$role->id) }}">ለአርትዖት</a>
                                        @endcan
                                        @can('role-delete')
                                        <form id="delete-form-{{ $role->id }}" action="{{ route('roles.destroy',$role->id) }}" style="display: none;" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <button type="button" class="btn btn-sm btn-danger" onclick="if(confirm('Are you sure? You want to delete this?')){
                                                                                                event.preventDefault();
                                                                                                document.getElementById('delete-form-{{ $role->id }}').submit();
                                                                                            }else {
                                                                                                event.preventDefault();
                                                                                                    }"><i class="fas fa-trash"></i>ለመሰረዝ</button>
                                        @endcan
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
@section('javascript')

@stop
@endsection