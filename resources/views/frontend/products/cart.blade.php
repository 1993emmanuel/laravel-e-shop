@extends('layouts.frontend')

@section('title')
    My Cart
@endsection

@section('content')

<div class="py-3 mb-4 shadow-sm bg-warning border-top">
    <div class="container">
        <h6 class="mb-0">
            <a href="{{ url('/') }}">Home</a> /
            <a href="{{ url('cart') }}">Cart</a>
        </h6>
    </div>
</div>

<div class="container my-5">
    <div class="card shadow">
        @if ($cartItems->count() >0)
            <div class="card-body">
                @php $total = 0;  @endphp
                @forelse ($cartItems as $cartItem )
                    <div class="row product_data">
                        <div class="col-md-2">
                            <img
                                class="pb-1"
                                height="70px" width="70px"
                                src="{{ asset('assets/uploads/products/'.$cartItem->products->image) }}" 
                                alt="Image here">
                        </div>
                        <div class="col-md-3">
                            <label for="productName" class="text-muted text-uppercase pb-1">Product Name</label>
                            <h6>{{ $cartItem->products->name }}</h6>
                        </div>
                        <div class="col-md-3">
                            <label for="selling_price" class="text-muted text-uppercase pb-1">Selling Price</label>
                            <h6>$ {{ $cartItem->products->selling_price }}</h6>
                        </div>
                        <div class="col-md-2">
                            <input type="hidden" class="prod_id" value="{{ $cartItem->product_id }}">
                            @if ($cartItem->products->qty >= $cartItem->product_qty)
                                <label for="Quantity">Quantity</label>
                                <div class="input-group text-center mb-3" style="width:130px;">
                                    <button class="input-group-text changeQuantity decrement-btn">-</button>
                                    <input 
                                        type="text" name="quantity" 
                                        class="form-control qty-input text-center" value="{{ $cartItem->product_qty }}">
                                    <button class="input-group-text changeQuantity increment-btn">+</button>
                                </div>
                                @php $total += $cartItem->products->selling_price*$cartItem->product_qty;  @endphp
                            @else
                                <h6>Out of Stock</h6>
                            @endif
                        </div>
                        <div class="col-md-2 d-flex align-items-center">
                            <button class="btn btn-danger btn-sm delete-cart-item">
                                <i class="fa fa-trash"></i> Remove
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="lead text-center">
                                No tienes productos en tu carrito, puedes agregar un producto dando clic
                                <a 
                                    style="text-decoration: none;"
                                    href="{{ url('category') }}">
                                    <i class="fa fa-shopping-bag"></i> Agregar Producto
                                </a>
                            </h5>
                        </div>
                    </div>
                @endforelse
            </div>
            <div class="card-footer">
                <h6>
                    Total de la compra : <i class="fa fa-shopping-bag"></i>{{$total}}
                    <a href="{{url('checkout')}}" class="btn btn-outline-success float-end">Proced to Checkout</a>
                </h6>
            </div>
        @endif
    </div>
</div>
@endsection