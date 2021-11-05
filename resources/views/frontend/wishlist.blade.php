@extends('layouts.frontend')

@section('title')
    My Wishlist
@endsection

@section('content')

<div class="py-3 mb-4 shadow-sm bg-warning border-top">
    <div class="container">
        <h6 class="mb-0">
            <a href="{{ url('/') }}">Home</a> /
            <a href="{{ url('wishlist') }}">Wishlist</a>
        </h6>
    </div>
</div>

<div class="container my-5">
    <div class="card shadow">
        <div class="card-body">
            @if ($wishlists->count() > 0)
                @foreach ($wishlists as $wishlist )
                    <div class="row product_data">
                        <div class="col-md-2">
                            <img
                                class="pb-1"
                                height="70px" width="70px"
                                src="{{ asset('assets/uploads/products/'.$wishlist->products->image) }}" 
                                alt="Image here">
                        </div>
                        <div class="col-md-2">
                            <label for="productName" class="text-muted text-uppercase pb-1">Product Name</label>
                            <h6>{{ $wishlist->products->name }}</h6>
                        </div>
                        <div class="col-md-2">
                            <label for="selling_price" class="text-muted text-uppercase pb-1">Selling Price</label>
                            <h6>$ {{ $wishlist->products->selling_price }}</h6>
                        </div>
                        <div class="col-md-2">
                            <input type="hidden" class="prod_id" value="{{ $wishlist->product_id }}">
                            @if ($wishlist->products->qty >= $wishlist->product_qty)
                                <label for="Quantity">Quantity</label>
                                <div class="input-group text-center mb-3" style="width:130px;">
                                    <button class="input-group-text decrement-btn">-</button>
                                    <input 
                                        type="text" name="quantity" 
                                        class="form-control qty-input text-center" value="1">
                                    <button class="input-group-text increment-btn">+</button>
                                </div>
                            @else
                                <h6>Out of Stock</h6>
                            @endif
                        </div>
                        <div class="col-md-2 d-flex align-items-center">
                            <button class="btn btn-success btn-sm addToCartBtn">
                                <i class="fa fa-shopping-cart"></i> Add to Cart
                            </button>
                        </div>
                        <div class="col-md-2 d-flex align-items-center">
                            <button class="btn btn-danger btn-sm removeWishListItem">
                                <i class="fa fa-trash"></i> Remove
                            </button>
                        </div>
                    </div>
                @endforeach
            @else
                <h4>There no products in your wishlist</h4>
            @endif
        </div>
    </div>
</div>
@endsection