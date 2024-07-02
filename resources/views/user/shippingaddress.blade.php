@extends('user.layouts.template')
@section('main-content')
    <div class="row">
        <h2 class="card-body">Provide Your Shipping Information</h2>
        <div class="col-12">
            <div class="box_main">
                <form action="{{ route('addshippingaddress') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" class="form-control" name="phone_number">
                    </div>
                    <div class="form-group">
                        <label for="city_name">City / Village Name</label>
                        <input type="text" class="form-control" name="city_name">
                    </div>
                    <div class="form-group">
                        <label for="postal_code">Postal Code</label>
                        <input type="text" class="form-control" name="postal_code">
                    </div>
                    <input type="submit" value="Next" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div class="card-body">
            <table class="table">
                <tr>
                    <th>Shipping Information</th>
                    <th>Action</th>
                </tr>
                @foreach ($shippings as $shipping)
                    <tr>
                        <td>
                            <ul>
                                <li>
                                    Phone Number - {{ $shipping->phone_number }}
                                </li>
                                <li>
                                    City - {{ $shipping->city_name }}
                                </li>
                                <li>
                                    Poscal Code - {{ $shipping->postal_code }}
                                </li>
                            </ul>
                        </td>
                        <td>
                            <a href="{{ route('chooseshippingaddress', $shipping->id) }}" class="btn btn-primary">Choose Now
                            </a>
                            <a href="{{ route('removeshippingaddress', $shipping->id) }}" class="btn btn-warning">Remove
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection()
