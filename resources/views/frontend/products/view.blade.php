@extends('layouts.frontend')

@section('title', $products->name)

@section('content')
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ url('add-rating') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{$products->id}}">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Rate {{$products->name}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="rating-css">
                        <div class="star-icon">
                            @if($user_rating)
                                @for($i=1; $i<=$user_rating->starts_rated; $i++ )
                                    <input type="radio" value="{{$i}}" name="product_rating" checked id="rating{{$i}}">
                                    <label for="rating{{$i}}" class="fa fa-star"></label>
                                @endfor
                                @for( $j= $user_rating->starts_rated+1; $j<=5; $j++ )
                                    <input type="radio" value="{{$j}}" name="product_rating" checked id="rating{{$j}}">
                                    <label for="rating{{$j}}" class="fa fa-star"></label>
                                @endfor
                            @else
                                <input type="radio" value="1" name="product_rating" checked id="rating1">
                                <label for="rating1" class="fa fa-star"></label>
                                <input type="radio" value="2" name="product_rating" id="rating2">
                                <label for="rating2" class="fa fa-star"></label>
                                <input type="radio" value="3" name="product_rating" id="rating3">
                                <label for="rating3" class="fa fa-star"></label>
                                <input type="radio" value="4" name="product_rating" id="rating4">
                                <label for="rating4" class="fa fa-star"></label>
                                <input type="radio" value="5" name="product_rating" id="rating5">
                                <label for="rating5" class="fa fa-star"></label>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- end modal --}}

    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h6 class="mb-0">Collections / {{$products->category->name}} / {{$products->name}}</h6>
        </div>
    </div>

    <div class="container">
        <div class="card shadow product_data">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 border-right">
                        <img src="{{ asset('assets/uploads/products/'.$products->image) }}" class="w-100" alt="Image product here">
                    </div>
                    <div class="col-md-8">
                        <h2 class="mb-0">
                            {{$products->name}}
                            @if ( $products->trending == '1' )
                                <label for="" style="font-size: 16px" class="float-end badge bg-danger trending_tag">
                                    Trending
                                </label>
                            @endif
                        </h2>

                        <hr>

                        <label for="" class="me-3">Original Price : <s> {{$products->original_price}}</s> </label>
                        <label for="" class="fw-bold">Selling Price : {{$products->selling_price}} </label>
                        @php $raternumber = number_format($rating_value) @endphp
                        <div class="ratting">
                            @for($i=1; $i<=$raternumber; $i++ )
                                <i class="fa fa-star checked"></i>
                            @endfor
                            @for( $j= $raternumber+1; $j<=5; $j++ )
                                <i class="fa fa-star"></i>
                            @endfor
                            @if ( $rating->count() >0 )
                                <span> {{ $rating->count() }} Rating</span>
                            @else
                                No rating
                            @endif
                        </div>
                        <p class="mt-3">
                            {!! $products->small_description !!}
                        </p>

                        <hr>

                        @if ($products->qty > 0 )
                            <label for="" class="badge bg-success">In Stock</label>
                        @else
                            <label for="" class="badge bg-danger">Out Stock</label>
                        @endif

                        <div class="row mt-2">
                            <div class="col-md-2">
                                <input type="hidden" value="{{$products->id}}" class="prod_id">
                                <label for="quantity">Quantity</label>
                                <div class="input group text-center mb-3" style="width:130px;">
                                    <span class="input-group-text decrement-btn">-</span>
                                    <input type="text" name="quantity" value="1" class="form-control qty-input" />
                                    <span class="input-group-text increment-btn">+</span>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <br>
                                @if ($products->qty > 0 )
                                    <button 
                                        type="button" 
                                        class="btn btn-primary me-3 float-start addToCartBtn">
                                            Add to card <i class="fa fa-shopping-cart"></i>
                                    </button>
                                @endif
                                <button 
                                    type="button" 
                                    class="btn btn-success me-3 float-start addToWishlistBtn">
                                        Add to wishlist <i class="fa fa-heart"></i>
                                </button>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Descripcion del Producto</h4>
                        <p>{{ $products->description}}</p>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Rate this product
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
