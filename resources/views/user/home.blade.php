@extends('user.layouts.template')
@section('main-content')
    <!-- fashion section start -->
    <div class="fashion_section">
        <div id="main_slider">
            <div class="container">
                <h1 class="fashion_taital">All Product</h1>
                <div class="fashion_section_2 gap-3">
                    <div class="row">
                        @foreach ($allproduct as $product)
                            <div class="col-lg-4 col-sm-4 my-3">
                                <div class="box_main w-100 h-100">
                                    <h4 class="shirt_text">{{ $product->product_name }}</h4>
                                    <p class="price_text">Price <span style="color: #262626;">
                                             {{ number_format($product->price, 0, '.', ',') }}</span></p>
                                    <div class="{{ $product->product_name }}">
                                        <img style="width:300px;height:300px; display: block;margin-left: auto;margin-right: auto;"
                                            src="{{ asset($product->product_img) }}">
                                    </div>
                                    <div class="btn_main" style="flex-direction: column; align-items: center;">
                                        <form action="{{ route('addproducttocart') }}" method="POST">
                                            @csrf
                                            <input type="hidden" value="{{ $product->id }}" name="product_id">
                                            <input type="hidden" value="{{ $product->price }}" name="price">
                                            <input type="hidden" value="1" name="quantity">
                                            <br>
                                            <input type="submit" value="Buy Now" class="btn btn-warning">
                                        </form>
                                        <div style="float:bottom" class="mt-2"><a
                                                href="{{ route('singleproduct', [$product->id, $product->slug]) }}">See
                                                More</a></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- fashion section end -->
@endsection()
