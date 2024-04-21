@extends('layouts.admin')
@section('title','ግለ ገፅ')
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
                        <h5 class="m-b-10">ግለ ገፅ</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">ግለ ገፅ</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>ግለ ገፅ</h5>
                @include('layouts.msg')
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('change.profile') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="first_name">የመጀመሪያ ስም</label>
                                <input type="text" name="first_name" required class="form-control" id="first_name" placeholder="የመጀመሪያ ስም" value="{{ Auth::user()->first_name }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="middle_name">የአባት ስም</label>
                                <input type="text" name="middle_name" required class="form-control" id="middle_name" placeholder="የአባት ስም" value="{{ Auth::user()->middle_name }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="last_name">የእናት ስም</label>
                                <input type="text" name="last_name" required class="form-control" id="last_name" placeholder="የእናት ስም" value="{{ Auth::user()->last_name }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">የኢሜይል አድራሻ</label>
                                <input type="text" name="email" required class="form-control" id="email" placeholder="" value="{{ Auth::user()->email }}" readonly>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">አዘምን</button>
                </form>
            </div>
        </div>
    </div>
</div>
@section('javascript')

@stop
@endsection