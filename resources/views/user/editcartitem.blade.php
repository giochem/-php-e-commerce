@extends('user.layouts.template')
@section('main-content')
    <div class="row">
        <div class="col-12">
            <div class="box_main">
                <div class="table-responsive">
                    <form action="{{ route('updatecartitem') }}" method="POST">
                        @csrf
                        <table class="table">
                            <tr>
                                <th>Product Image</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Action</th>
                            </tr>
                            <tr>
                                @php
                                    $product = App\Models\Product::where('id', $item->product_id)->first();
                                @endphp
                                <td><img src="{{ asset($product->product_img) }}" style="height: 50px;" alt="">
                                </td>
                                <td>{{ $product->product_name }}</td>
                                <td class="form-group">
                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                    <input class="form-control" type="number" min="1" value="{{ $item->quantity }}"
                                        name="quantity">
                                </td>
                                <td>
                                    <input type="submit" value="Update" class="btn btn-warning">
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection()
