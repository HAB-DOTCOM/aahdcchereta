@extends('layouts.admin')
@section('title','ቤቶች')
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
                        <h5 class="m-b-10">ቤቶች</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">ቤቶች</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>አዲስ ቤት ጨምር</h5>
                @include('layouts.msg')
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('admin.createHouse') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="building_number">የሕንፃ ቁጥር</label>
                                <input type="text" name="building_number" required class="form-control" id="building_number" placeholder="የሕንፃ ቁጥር">
                            </div>

                            <div class="form-group">
                                <label for="site_name">የሳይት ስም</label>
                                <input type="text" name="site_name" required class="form-control" id="site_name" placeholder="የሳይት ስም">
                            </div>

                            <div class="form-group">
                                <label for="bedroom_number">የመኝታ ቤት ብዛት</label>
                                <input type="number" name="bedroom_number" required class="form-control" id="bedroom_number" placeholder="የመኝታ ቤት ብዛት">
                            </div>

                            <div class="form-group">
                                <label for="net_house_area">የተጣራ የቤት ስፋት</label>
                                <input type="number" name="net_house_area" required class="form-control" id="net_house_area" placeholder="የተጣራ የቤት ስፋት">
                            </div>

                            <div class="form-group">
                                <label for="total_house_area">ጠቅላላ የቤት ስፋት</label>
                                <input type="number" name="total_house_area" required class="form-control" id="total_house_area" placeholder="ጠቅላላ የቤት ስፋት">
                            </div>

                            <div class="form-group">
                                <label for="inputState">ምድብ</label>
                                <select name="category_id" id="inputState" class="form-control">
                                    <option selected>ምድብ ምረጥ</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="sub_city_wereda">ክፍለ ከተማ / ወረዳ</label>
                                <input type="text" name="sub_city_wereda" required class="form-control" id="sub_city_wereda" placeholder="ክፍለ ከተማ / ወረዳ">
                            </div>

                            <div class="form-group">
                                <label for="house_number">የቤት ቁጥር</label>
                                <input type="text" name="house_number" required class="form-control" id="house_number" placeholder="የቤት ቁጥር">
                            </div>

                            <div class="form-group">
                                <label for="house_height">የቤት ቁመት / ከፍታ</label>
                                <input type="number" name="house_height" required class="form-control" id="house_height" placeholder="የቤት ቁመት / ከፍታ">
                            </div>

                            <div class="form-group">
                                <label for="floor_number">የወለል ቁጥር</label>
                                <input type="number" name="floor_number" required class="form-control" id="floor_number" placeholder="የወለል ቁጥር">
                            </div>

                            <div class="form-group">
                                <label for="common_area">የጋራ ቦታ</label>
                                <input type="number" name="common_area" required class="form-control" id="common_area" placeholder="የጋራ ቦታ">
                            </div>

                            <div class="form-group">
                                <label for="price_per_square">ዋጋ በካሬ</label>
                                <input type="number" name="initial_price_per_square" required class="form-control" id="price_per_square" placeholder="Price Per Square">
                            </div>

                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">አስገባ</button>
                </form>
            </div>
        </div>
    </div>
</div>
@section('javascript')

@stop
@endsection