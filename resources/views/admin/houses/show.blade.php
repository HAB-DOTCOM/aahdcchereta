@extends('layouts.admin')
@section('title', 'የቤት ዝርዝር መረጃ')
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
                        <h5 class="m-b-10">የቤት ዝርዝር መረጃ</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">የቤት ዝርዝር መረጃ</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>የቤት ዝርዝር መረጃ</h5>
                @include('layouts.msg')
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="building_number">የሕንፃ ቁጥር</label>
                            <input type="text" name="building_number" required class="form-control" id="building_number" placeholder="የሕንፃ" value="{{ old('building_number', $house->building_number) }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="site_name">የሳይት ስም</label>
                            <input type="text" name="site_name" required class="form-control" id="site_name" placeholder="የሳይት" value="{{ old('site_name', $house->site_name) }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="bedroom_number">የመኝታ ቤት ብዛት</label>
                            <input type="text" name="bedroom_number" required class="form-control" id="bedroom_number" placeholder="የመኝታ" value="{{ old('bedroom_number', $house->bedroom_number) }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="net_house_area">የተጣራ የቤት ስፋት</label>
                            <input type="text" name="net_house_area" required class="form-control" id="net_house_area" placeholder="የተጣራ የቤት ስፋት" value="{{ old('net_house_area', $house->net_house_area) }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="total_house_area">ጠቅላላ የቤት ስፋት</label>
                            <input type="text" name="total_house_area" required class="form-control" id="total_house_area" placeholder="ጠቅላላ የቤት ስፋት" value="{{ old('total_house_area', $house->total_house_area) }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="inputState">ምድብ</label>
                            <input type="text" name="category" required class="form-control" id="category" placeholder="ምድብ" value="{{ old('category', $house->houseCategory->name ) }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="sub_city_wereda">ክፍለ ከተማ / ወረዳ</label>
                            <input type="text" name="sub_city_wereda" required class="form-control" id="sub_city_wereda" placeholder="ክፍለ ከተማ / ወረዳ" value="{{ old('sub_city_wereda', $house->sub_city_wereda) }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="house_number">የቤት ቁጥር</label>
                            <input type="text" name="house_number" required class="form-control" id="house_number" placeholder="የቤት ቁጥር" value="{{ old('house_number', $house->house_number) }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="house_height">የቤት ቁመት / ከፍታ</label>
                            <input type="text" name="house_height" required class="form-control" id="house_height" placeholder="የቤት ቁመት / ከፍታ" value="{{ old('house_height', $house->house_height) }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="floor_number">የወለል ቁጥር</label>
                            <input type="text" name="floor_number" required class="form-control" id="floor_number" placeholder="የወለል ቁጥር" value="{{ old('floor_number', $house->floor_number) }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="common_area">የጋራ ቦታ</label>
                            <input type="text" name="common_area" required class="form-control" id="common_area" placeholder="የጋራ ቦታ" value="{{ old('common_area', $house->common_area) }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="price_per_square">ዋጋ በካሬ</label>
                            <input type="text" name="initial_price_per_square" required class="form-control" id="price_per_square" placeholder="ዋጋ በካሬ" value="{{ old('initial_price_per_square', $house->initial_price_per_square) }}" readonly>
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