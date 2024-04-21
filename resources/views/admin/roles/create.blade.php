@extends('layouts.admin')
@section('title','አዲስ ሚና መጨመሪያ')
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
                        <h5 class="m-b-10">አዲስ ሚና መጨመሪያ</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">አዲስ ሚና መጨመሪያ</a></li>
                    </ul> <br> <br>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>አዲስ ሚና መጨመሪያ</h5>
                    @include('layouts.msg')
                </div>
                <div class="card-body table-border-style">
                    <div class="container">
                        <form method="POST" action="{{ route('roles.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">

                                    <div class="form-group">
                                        <label for="name">ስም:</label>
                                        <input type="text" class="form-control" placeholder="የሚና ስም" name="name" />
                                    </div>
                                </div>
                                <div class="row">
                                    @if($permission->isNotEmpty())
                                    @php
                                    $totalPermissions = count($permission);
                                    $permissionsPerColumn = ceil($totalPermissions / 3);
                                    $columnCount = 1;
                                    @endphp

                                    @foreach($permission as $key => $perm)
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>
                                                <input type="checkbox" name="permission[]" value="{{ $perm->id }}" class="name">
                                                {{ $perm->name }}
                                            </label><br>
                                        </div>
                                    </div>


                                    @if(($key + 1) % $permissionsPerColumn === 0 || $key === $totalPermissions - 1)
                                    @php $columnCount++; @endphp
                                    @endif
                                    @endforeach
                                    @else
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <p>ምንም ፈቃዶች የሉም።</p>
                                        </div>
                                    </div>
                                    @endif
                                </div>

                                <div>
                                    <button class="btn btn-raised btn-primary waves-effect" onclick="this.form.submit()" type="submit">አስገባ</button>
                                </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
@section('javascript')

@stop
@endsection