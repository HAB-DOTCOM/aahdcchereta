@extends('layouts.admin')
@section('title','የይለፍ ቃል')
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
                        <h5 class="m-b-10">የይለፍ ቃል</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">የይለፍ ቃል</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>የይለፍ ቃል</h5>
                @include('layouts.msg')
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('change.password') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputCP">የአሁኑ የይለፍ ቃል</label>
                                <input type="password" name="current-password" required class="form-control" id="InputCP" placeholder="የአሁኑ የይለፍ ቃል">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputNP">አዲስ የይለፍ ቃል</label>
                                <input type="password" name="new-password" required class="form-control" id="InputNP" placeholder="አዲስ የይለፍ ቃል">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="InputCNP">አዲሱን የይለፍ ቃል ያረጋግጡ</label>
                                <input type="password" name="new-password-confirm" required class="form-control" id="InputCNP" placeholder="አዲሱን የይለፍ ቃል ያረጋግጡ">
                            </div>
                        </div>
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <a onclick="myFunction()" class="btn btn-success btn-circle btn-sm">
                                <i class="fas fa-check"></i>
                            </a> የይለፍ ቃላትን አሳይ <br> <br><br>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">አዘምን</button>
                </form>
            </div>
        </div>
    </div>
</div>
@section('javascript')
<script type="text/javascript">
    function myFunction() {
        var InputCP = document.getElementById("InputCP");
        var InputNP = document.getElementById("InputNP");
        var InputCNP = document.getElementById("InputCNP");
        if (InputCP.type === "password") {
            InputCP.type = "text";
        } else {
            InputCP.type = "password";
        }

        if (InputNP.type === "password") {
            InputNP.type = "text";
        } else {
            InputNP.type = "password";
        }
        if (InputCNP.type === "password") {
            InputCNP.type = "text";
        } else {
            InputCNP.type = "password";
        }
    }
</script>
@stop
@endsection