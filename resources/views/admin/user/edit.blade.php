@extends('layouts.admin')
@section('title','የሲስተም ተጠቃሚ መረጃ ማደሻ')
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
                        <h5 class="m-b-10">የሲስተም ተጠቃሚ መረጃ ማደሻ</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">የሲስተም ተጠቃሚ መረጃ ማደሻ</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>የሲስተም ተጠቃሚ መረጃ ማደሻ</h5>
                @include('layouts.msg')
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form class="forms-sample" method="post" action="{{ route('admin.createUser') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="first_name">ስም</label>
                                        <input type="text" class="form-control" name="first_name" value="{{ $user->first_name }}" placeholder="ስም" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="middle_name">የ አባት ስም</label>
                                        <input type="text" class="form-control" name="middle_name" value="{{ $user->middle_name }}" placeholder="የ አባት ስም" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="last_name">የ አያት ስም</label>
                                        <input type="text" class="form-control" name="last_name" value="{{ $user->last_name }}" placeholder="የ አያት ስም ስም" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email">ኢሜል</label>
                                <input type="email" class="form-control" id="email" value="{{ $user->email }}" name="email" placeholder="ኢሜል" required>
                            </div>
                            <div class="form-group">
                                <label for="password">የይለፍ ቃል</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="የይለፍ ቃል" required>
                                <small id="togglePassword" onclick="togglePasswordVisibility()">የይለፍ ቃል አሳይ</small>
                            </div>
                            <div class="form-group">
                                <label for="role">ሚና ይምረጡ</label>
                                <select class="form-control" id="role" name="role" required>
                                    @foreach($roles as $role)
                                    <option value="{{ $role }}">{{ $role }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary me-2">መዝግብ</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('javascript')
<script type="text/javascript">
    function togglePasswordVisibility() {
        var InputCP = document.getElementById("password");
        if (InputCP.type === "password") {
            InputCP.type = "text";
        } else {
            InputCP.type = "password";
        }
    }
</script>
@stop
@endsection