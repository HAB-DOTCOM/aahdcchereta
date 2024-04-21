@extends('layouts.admin')
@section('title','ክንውኖች')
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
                        <h5 class="m-b-10">ክንውኖች</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">ክንውኖች</a></li>
                    </ul> <br> <br>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>በ {{ $user->first_name }} የተደረጉ ክንውኖች</h5>
                    @include('layouts.msg')
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive table-bordered">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ተ.ቁ.</th>
                                    <th>ድርጊት</th>
                                    <th>አድራጊ</th>
                                    <th>የተደረገበት ጊዜ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($uLogs as $key=>$log)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $log->action }}</td>
                                    <td><a href="{{ route('admin.userLog',$log->user_id) }}"> {{optional($log->user)->first_name}}</a> </td>
                                    <td>{{ Carbon\Carbon::parse($log->created_at)->format('F d, Y') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <p>ምንም አልተገኘም።</p>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $uLogs->links('pagination::bootstrap-4') }}
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