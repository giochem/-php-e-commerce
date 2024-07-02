@extends('admin.layouts.template')
@section('page_title')
    Approve Order - Ecommerce
@endsection
@section('content')
    <div class="container my-5">
        <div class="card p-4">
            <div class="card-title">
                <h2 class="text-center">Approve Order</h2>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th>User Name</th>
                        <th>Shipping Information</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Total Will Pay</th>
                    </tr>
                    @foreach ($approve_orders as $order)
                        @php
                            $user_id = $order->user_id;
                            $product_id = $order->product_id;
                            $user = App\Models\User::where(['id' => $user_id])->first();
                            $product = App\Models\Product::where(['id' => $product_id])->first();
                        @endphp
                        <tr>
                            <td>{{ $user->name }}</td>
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
                            <td>{{ $order->total_price }}</th>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
