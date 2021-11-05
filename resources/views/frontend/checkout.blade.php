@extends('layouts.frontend')

@section('title')
    Checkout
@endsection

@section('content')

<div class="container mt-3">
    <form action="{{ url('place-order') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <h6>Basic Details</h6>
                        <hr>
                        <div class="row checkout-form">
                            <div class="col-md-6">
                                <label for="firstName">First Name</label>
                                <input 
                                    value="{{ Auth::user()->name }}"
                                    type="text" class="form-control" name="fname" placeholder="Enter first name">
                            </div>
                            <div class="col-md-6">
                                <label for="lastName">Last Name</label>
                                <input 
                                    value="{{ Auth::user()->lname }}"
                                    type="text" class="form-control" name="lname" placeholder="Enter last name">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="email">Email</label>
                                <input 
                                    value="{{ Auth::user()->email }}"
                                    type="text" class="form-control" name="email" placeholder="Enter email">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="phoneNumber">Phone Number</label>
                                <input 
                                    value="{{ Auth::user()->phone }}"
                                    type="text" class="form-control" name="phone" placeholder="Enter Phone Number">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="address1">Address 1</label>
                                <input 
                                    value="{{ Auth::user()->address1 }}"
                                    type="text" class="form-control" name="address1" placeholder="Enter Address 1">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="address2">Address 2</label>
                                <input 
                                    value="{{ Auth::user()->address2 }}"
                                    type="text" class="form-control" name="address2" placeholder="Enter Address 2">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="city">City</label>
                                <input 
                                    value="{{ Auth::user()->city }}"
                                    type="text" class="form-control" name="city" placeholder="Enter City">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="state">State</label>
                                <input 
                                    value="{{ Auth::user()->state }}"
                                    type="text" class="form-control" name="state" placeholder="Enter state">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="country">Country</label>
                                <input 
                                    value="{{ Auth::user()->country }}"
                                    type="text" class="form-control" name="country" placeholder="Enter country">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="pincode">Pin Code</label>
                                <input 
                                    value="{{ Auth::user()->pincode }}"
                                    type="text" class="form-control" name="pincode" placeholder="Enter pincode">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        Order Details
                        <hr>
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Product Quantity</th>
                                    <th>Product Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cartitems as $cartItem )
                                <tr>
                                    <td>{{$cartItem->products->name}}</td>
                                    <td>{{$cartItem->product_qty}}</td>
                                    <td>$ {{$cartItem->products->selling_price}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <hr>
                        <button type="submit" class="btn btn-outline-info float-end">Place Order</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection