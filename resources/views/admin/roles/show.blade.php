@extends('layouts.admin')
@section('title','Roles')
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
                        <h5 class="m-b-10">Roles</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">Roles</a></li>
                    </ul> <br> <br>
                    <a href="{{ route('roles.create') }}" class="btn  btn-primary">Add New</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Role: {{ $role->name }}</h5>
                    @include('layouts.msg')
                </div>
                <div class="card-body table-border-style">
                    @if(!empty($rolePermissions))
                    @foreach($rolePermissions as $v)
                    <label class="label label-success badge badge-success ">{{ $v->name }}</label>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>
@section('javascript')

@stop
@endsection