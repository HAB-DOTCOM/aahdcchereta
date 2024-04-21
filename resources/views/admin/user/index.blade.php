@extends('layouts.admin')
@section('title','የሲስተም ተጠቃሚዎች')
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
                        <h5 class="m-b-10">የሲስተም ተጠቃሚዎች</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">የሲስተም ተጠቃሚዎች</a></li>
                    </ul> <br> <br>
                    @can('user-create')
                    <a href="{{ route('admin.user.create') }}" class="btn  btn-primary">አዲስ ለመመዝገብ</a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>የሲስተም ተጠቃሚዎች</h5>
                    @include('layouts.msg')
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ተ.ቁ.</th>
                                    <th>ሙሉ ስም</th>
                                    <th>የኢሜይል አድራሻ</th>
                                    <th>ሚና</th>
                                    <th>ድርጊት</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $key=>$user)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $user->first_name }} {{ $user->middle_name ?? '-' }} {{ $user->last_name ?? '-' }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if(!empty($user->getRoleNames()))
                                        @foreach($user->getRoleNames() as $v)
                                        <label class="badge badge-success">{{ $v }}</label>
                                        @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        @can('user-create')
                                        <a href="{{ route('admin.editUser',$user->id) }}" class="btn btn-sm btn-success">ለአርቶዖት</a>
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