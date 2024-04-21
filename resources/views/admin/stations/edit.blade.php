@extends('layouts.admin')
@section('title','የምዝገባ ጣቢያ መረጃ ማስተካከያ')
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
                        <h5 class="m-b-10">የምዝገባ ጣቢያ መረጃ ማስተካከያ</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">የምዝገባ ጣቢያ መረጃ ማስተካከያ</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>የምዝገባ ጣቢያ መረጃ ማስተካከያ</h5>
                @include('layouts.msg')
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('admin.updateBidderStation', $station->id) }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">የምዝገባ ጣቢያ ስም</label>
                                <input type="text" name="name" value="{{ $station->name }}" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="የምዝገባ ጣቢያ ስም">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail11">የምዝገባ ጣቢያ ስም</label>
                                <input type="text" name="description" value="{{ $station->description }}" required class="form-control" id="exampleInputEmail11" aria-describedby="emailHelp" placeholder="የምዝገባ ጣቢያ ስም">
                            </div>
                            <button type="submit" class="btn  btn-primary">አዘምን</button>
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