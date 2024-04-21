@extends('layouts.admin')
@section('title','የተጫራቾች በብዛት መመዝገቢያ')
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
                        <h5 class="m-b-10">የተጫራቾች በብዛት መመዝገቢያ</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">የተጫራቾች በብዛት መመዝገቢያ</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>የተጫራቾች በብዛት መመዝገቢያ </h5>
                @include('layouts.msg')
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('import.bidders') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="inputState">ጣቢያ</label>
                                <select name="biider_station_id" id="inputState" class="form-control">
                                    <option selected>ጣቢያ ምረጥ</option>
                                    @foreach($stations as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">ፋይል ጫን</label>
                                <small>ፋይሉ xls ወይም xlsx መሆን አለበት።</small>
                                <input type="file" name="file" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Category Name">
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