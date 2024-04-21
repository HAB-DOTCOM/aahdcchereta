@extends('layouts.admin')
@section('title','ውል')
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
                        <h5 class="m-b-10">ውል</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">ውል</a></li>
                    </ul> <br> <br>
                    <a href="{{ route('admin.agreement.create') }}" class="btn  btn-primary">አዲስ ውል ለማዋዋል</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>ውል</h5>
                    @include('layouts.msg')
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive table-bordered">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ተ.ቁ.</th>
                                    <th>የሕንፃ ቁጥር</th>
                                    <th>ክፍለ ከተማ / ወረዳ</th>
                                    <th>የሳይት ስም</th>
                                    <th>የቤት ቁጥር</th>
                                    <th>ድርጊት</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($agreements as $key=>$agreement)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $agreement->building_number }}</td>
                                    <td>{{ $agreement->sub_city_wereda }}</td>
                                    <td>{{ $agreement->site_name }}</td>
                                    <td>{{ $agreement->house_number }}</td>
                                    <td>
                                        <a href="{{ route('admin.updateHouse', $agreement->id) }}" class="btn btn-sm btn-success">Edit</a>
                                        <a href="{{ route('admin.showHouse', $agreement->id) }}" class="btn btn-sm btn-success">Show</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <p>ምንም አልተገኘም።</p>
                                </tr>
                                @endforelse
                  
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                        {{ $agreements->links('pagination::bootstrap-4') }}
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