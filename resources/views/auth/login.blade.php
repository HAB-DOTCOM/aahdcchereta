<!DOCTYPE html>
<html lang="en">

<head>

    <title>IRCBAMIS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="Phoenixcoded" />
    <link rel="icon" href="/assets/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<div class="auth-wrapper">
    <div class="auth-content text-center">
        <img src="/assets/images/logo_white.png" style="width: 100px;" alt="" class="img-fluid mb-4">
        <div class="card borderless">
            <div class="row align-items-center ">
                <div class="col-md-12">
                    <div class="card-body">
                        <h4 class="mb-3 f-w-400">ይግቡ</h4>
                        @include('layouts.msg')
                        <hr>
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" name="email" class="form-control" id="Email" placeholder="የኢሜል አድራሻ" required>
                            </div>
                            <div class="form-group mb-4">
                                <input type="password" class="form-control" name="password" id="Password" placeholder="የይለፍ ቃል" required>
                            </div>
                            <div class="custom-control custom-checkbox text-left mb-4 mt-2">
                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                <label class="custom-control-label" for="customCheck1">አስታውሰኝ</label>
                            </div>
                            <button class="btn btn-block btn-primary mb-4">ይግቡ</button>
                            <hr>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ auth-signin ] end -->

<!-- Required Js -->
<script src="/assets/js/vendor-all.min.js"></script>
<script src="/assets/js/plugins/bootstrap.min.js"></script>

<script src="/assets/js/pcoded.min.js"></script>



</body>

</html>