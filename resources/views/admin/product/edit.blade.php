@extends('layouts.admin')


@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Edit Product {{$product->name}}</h4>
        </div>
        <div class="card-body">
            <form action="{{url('update-product',$product->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="cate_id">Selecciona la categoria</label>
                        <select class="form-select" aria-label="Default select example" name="cate_id">
                            <option value="" disabled>Select Value</option>
                            @foreach ($categories as $category )
                                <option 
                                    {{$category->id == $product->cate_id ? 'selected' : ''}}
                                    value="{{$category->id}}">
                                    {{$category->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="name">Name</label>
                        <input 
                            type="text" name="name" id="name" 
                            class="form-control" placeholder="Ingresa nombre del producto" value="{{$product->name}}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="slug">Slug</label>
                        <input 
                            type="text" name="slug" id="slug" value="{{$product->slug}}"
                            class="form-control" placeholder="Ingresa el slug del producto">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="small_description">Small Description</label>
                        <textarea 
                            name="small_description" id="small_description" rows="3" 
                            class="form-control" placeholder="Ingresa la small descripcion del producto">{{$product->small_description}}</textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="description">Description</label>
                        <textarea 
                            name="description" id="description" rows="3" 
                            class="form-control" placeholder="Ingresa la descripcion del producto">{{$product->description}}</textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="original_price">Original Price</label>
                        <input 
                            type="number" name="original_price" id="original_price" value="{{$product->original_price}}"
                            class="form-control" placeholder="ingrese el precio original">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="selling_price">Selling Price</label>
                        <input 
                            type="number" name="selling_price" id="selling_price"  value="{{$product->selling_price}}"
                            class="form-control" placeholder="ingreseel precio de venta">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="tax">Tax</label>
                        <input 
                            type="number" name="tax" id="tax" value="{{$product->tax}}"
                            class="form-control" placeholder="ingrese el impuesto">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="qty">Quantity</label>
                        <input 
                            type="number" name="qty" id="qty" value="{{$product->qty}}"
                            class="form-control" placeholder="ingrese la cantidad">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="status">Status</label>
                        <input type="checkbox" name="status" id="status" {{ $product->status == "1" ? 'checked' : '' }} >
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="trending">Trending</label>
                        <input type="checkbox" name="trending" id="trending" {{$product->trending == '1' ? 'checked' : ''}} >
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="meta_title">Meta Title</label>
                        <input 
                            type="text" name="meta_title" id="meta_title" value="{{$product->meta_title}}"
                            class="form-control" placeholder="Ingresa el meta titulo del producto">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="meta_keywords">Meta KeyWords</label>
                        <textarea 
                            type="text" name="meta_keywords" id="meta_keywords"
                            class="form-control" placeholder="Ingresa los meta keywords del producto">{{$product->meta_keywords}}</textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="meta_description">Meta Description</label>
                        <textarea 
                            name="meta_description" id="meta_description" rows="3" 
                            class="form-control" placeholder="Inggresa la meta descripcion del producto">{{$product->meta_description}}</textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        @if ($product->image)
                            <img src="{{asset('assets/uploads/products/'.$product->image)}}" alt="Product image here">
                        @endif
                        <input 
                            type="file" name="image" id="image" 
                            class="form-control" placeholder="Carga una foto del producto">
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Editar Product</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection