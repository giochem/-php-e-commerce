@extends('user.layouts.template')
@section('main-content')
    <div class="row">
        <h2 class="col-12">Final Step To place Your Order</h2>
        <div class="col-8">
            <div class="box_main">
                <h3>Product Send At</h3>
                <p>City/Viallage: {{ $shipping_address->city_name }}</p>
                <p>Postal Code: {{ $shipping_address->postal_code }}</p>
                <p>Phone Number: {{ $shipping_address->phone_number }}</p>
            </div>
        </div>
        <div class="col-4">
            <div class="box_main">
                Your Final Products Are
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                        @php
                            $total = 0;
                        @endphp
                        @foreach ($cart_items as $item)
                            <tr>
                                @php
                                    $product = App\Models\Product::where('id', $item->product_id)->first();
                                @endphp
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>đ {{ $item->price }}</td>
                            </tr>
                            @php
                                $total = $total + $item->price;
                            @endphp
                        @endforeach
                        <tr>
                            <td></td>
                            <td>Total</td>
                            <td>đ {{ $total }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <form class="col-2" action="" method="POST">
            @csrf
            <input type="submit" value="Cancel Order" class="btn btn-danger">
        </form>
        <form action="{{ route('placeorder') }}" method="POST">
            @csrf
            <input type="submit" value="Place Order" class="btn btn-primary ">
        </form>
    </div>
@endsection()
