@extends('layouts.admin')
@section('title','ዳሽቦርድ')
@section('css')
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
@stop
@section('content')
<div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">ዳሽቦርድ</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">ዳሽቦርድ</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3">ቤቶች</h5>
                    <h2>{{ $houses }}<span class="text-muted m-l-5 f-14"></span></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3">ተጫራቾች</h5>
                    <h2>{{ $bidders }}<span class="text-muted m-l-5 f-14"></span></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3">የቤቶች ምድቦች</h5>
                    <h2>{{ $housescategory }}<span class="text-muted m-l-5 f-14"></span></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3">የሲስተም ተጠቃሚዎች</h5>
                    <h2>{{ $users }}<span class="text-muted m-l-5 f-14"></span></h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            {!! $chart->container() !!}
        </div>
        <div class="col-md-6">
            {!! $chart2->container() !!}
        </div>

    </div>
</div>

@section('javascript')
<!-- <script src="{{ $chart->cdn() }}"></script>
<script src="{{ $chart2->cdn() }}"></script> -->

{{ $chart->script() }}
{{ $chart2->script() }}
@stop
@endsection