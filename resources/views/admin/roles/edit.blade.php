@extends('layouts.admin')
@section('title','የሚና መረጃ ማዘመኛ')
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
                        <h5 class="m-b-10">የሚና መረጃ ማዘመኛ</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">የሚና መረጃ ማዘመኛ</a></li>
                    </ul> <br> <br>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>የሚና መረጃ ማዘመኛ</h5>
                    @include('layouts.msg')
                </div>
                <div class="card-body table-border-style">
                    <div class="container">
                        <form action="{{ route('roles.update',$role->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">

                                    <div class="form-group">
                                        <label for="name">Name:</label>
                                        <input value="{{ $role->name }}" type="text" class="form-control" placeholder="name" name="name" />
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Permissions:</strong>
                                        <br /><br />
                                        <div class="row">
                                            @php
                                            $permissions = $permission->toArray();
                                            $totalPermissions = count($permissions);
                                            $permissionsPerColumn = ceil($totalPermissions / 3);

                                            $columnCount = 0;
                                            @endphp

                                            @foreach($permissions as $value)
                                            <div class="col-xs-4 col-sm-4 col-md-4">
                                                <label>
                                                    <input type="checkbox" name="permission[]" value="{{ $value['id'] }}" @if(in_array($value['id'], $rolePermissions)) checked @endif> {{ $value['name'] }}
                                                </label>
                                            </div>
                                            @php $columnCount++; if ($columnCount === $permissionsPerColumn || $loop->last) { $columnCount = 0; echo '</div>';
                                                if (!$loop->last) {
                                                    echo '<div class="row">';
                                                        }
                                                    }
                                            @endphp
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <button class="btn btn-raised btn-primary waves-effect" onclick="this.form.submit()" type="submit">አዘምን</button>
                                </div>
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