@extends('layouts.admin')
@section('title','የቤት ምድብ ዝርዝር መረጃ')
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
                        <h5 class="m-b-10">የቤት ምድብ ዝርዝር መረጃ</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">የቤት ምድብ ዝርዝር መረጃ</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>የቤት ምድብ ዝርዝር መረጃ</h5>
                @include('layouts.msg')
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form>
                            <div class="form-group">
                                <label for="exampleInputEmail1">የምድብ ስም</label>
                                <div class="alert alert-dark" role="alert">
                                    {{ $category->name }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">የምድብ መግለጫ</label>
                                <div class="alert alert-dark" role="alert">
                                    {{ $category->description }}
                                </div>
                            </div>
                            <a href="{{ route('admin.housecategories') }}" class="btn  btn-primary">ተመለስ</a>
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