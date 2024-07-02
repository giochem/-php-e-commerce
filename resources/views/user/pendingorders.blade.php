@extends('user.layouts.user_profile_template')
@section('profilecontent')
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif
    <table class="table">
        <tr>
            <th>Shipping Information</th>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Total Will Pay</th>
        </tr>
        @foreach ($pending_orders as $order)
            @php
                $user_id = $order->user_id;
                $product_id = $order->product_id;
                $user = App\Models\User::where(['id' => $user_id])->first();
                $product = App\Models\Product::where(['id' => $product_id])->first();
            @endphp
            <tr>
                <td>
                    <ul>
                        <li>
                            Phone Number - {{ $order->shipping_phone_number }}
                        </li>
                        <li>
                            City - {{ $order->shipping_city }}
                        </li>
                        <li>
                            Poscal Code - {{ $order->shipping_postal_code }}
                        </li>
                    </ul>
                    </th>
                <td>{{ $product->product_name }}</th>
                <td>{{ $order->quantity }}</th>
                <td>đ {{ $order->total_price }}</th>
            </tr>
        @endforeach
    </table>
@endsection()
