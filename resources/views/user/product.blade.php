@extends('user.layouts.template')
@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="box_main">
                    <div class="tshirt_img"><img src="{{ asset($product->product_img) }}" alt=""></div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="box_main">
                    <div class="product-info">
                        <h4 class="shirt_text text-left">{{ $product->product_name }}</h4>
                        <p class="price_text text-left">Price <span style="color: #262626;">đ {{ $product->price }}</span>
                        </p>
                    </div>
                    <div class="my-3 product-details">
                        <p class="lead">
                            {{ $product->product_long_des }}
                        </p>
                        <ul class="p-2 bg-light my-2">
                            <li>Subcategory - {{ $product->product_category_name }}</p>
                            <li>Sub Category - {{ $product->product_subcategory_name }}</p>
                            <li>Available Quantity - {{ $product->quantity }}</p>
                        </ul>
                    </div>
                    <div class="btn_main">
                        <form action="{{ route('addproducttocart') }}" method="POST">
                            @csrf
                            <input type="hidden" value="{{ $product->id }}" name="product_id">
                            <div class="form-group">
                                <input type="hidden" name="price" value="{{ $product->price }}">
                                <label for="quantity">How many product do you want to buy ?</label>
                                <input class="form-control" type="number" min="1" value="1" name="quantity">
                            </div>
                            <br>
                            <input type="submit" value="Add To Cart" class="btn btn-warning">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="fashion_section">
            <div id="main_slider">
                <div class="container">
                    <h1 class="fashion_taital">Related Poducts</h1>
                    <div class="fashion_section_2">
                        <div class="row">
                            @foreach ($related_products as $product)
                                <div class="col-lg-4 col-sm-4 my-3">
                                    <div class="box_main w-100 h-100">
                                        <h4 class="shirt_text">{{ $product->product_name }}</h4>
                                        <p class="price_text">Price <span style="color: #262626;">
                                               đ {{ $product->price }}</span></p>
                                        <div class="{{ $product->product_name }}"><img
                                                style="width:300px;height:300px; display: block;margin-left: auto;margin-right: auto;"
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
    </div>
@endsection()
