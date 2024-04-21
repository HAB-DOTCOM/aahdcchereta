@extends('layouts.admin')
@section('title','የቤቶች በብዛት መመዝገቢያ')
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
                        <h5 class="m-b-10">የቤቶች በብዛት መመዝገቢያ</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">የቤቶች በብዛት መመዝገቢያ</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>የቤቶች በብዛት መመዝገቢያ </h5>
                @include('layouts.msg')
                <!-- Loading animation -->
                <div id="loading-overlay" style="display: none;">
                    <div id="loading-content">
                        <video width="100%" height="100%" autoplay loop>
                            <source src="{{ asset('AuctionManagement/assets/loading/istockphoto-1302436594-640_adpp_is.mp4') }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form id="importForm" action="{{ route('mimport.houses') }}" method="post" enctype="multipart/form-data">

                            @csrf
                            <div class="form-group">
                                <label for="inputState">የቤት ምድብ</label>
                                <select name="category_id" id="inputState" class="form-control">
                                    <option selected>ምድብ መረጥ</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">ፋይል ጫን</label>
                                <small>ፋይሉ xls ወይም xlsx መሆን አለበት።</small>
                                <input type="file" name="file" required class="form-control" id="file" aria-describedby="emailHelp" placeholder="Category Name">
                            </div>

                            <button type="submit" class="btn  btn-primary">መዝግብ</button>
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