@extends('layouts.admin')


@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Products Page</h4>
            <hr>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Category</th>
                        <th>Name</th>
                        <th>Original Price</th>
                        <th>Selling Price</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product )
                        <tr>
                            <td>{{$product->id}}</td>
                            <td>{{$product->category->name}}</td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->original_price}}</td>
                            <td>{{$product->selling_price}}</td>
                            <td>
                                <img
                                    class="cate-image"
                                    src="{{ asset('assets/uploads/products/'.$product->image) }}" alt="Image here">
                            </td>
                            <td>
                                <a 
                                    href="{{url('edit-prod/'.$product->id)}}"
                                    class="btn btn-primary">Edit</a>
                                <a 
                                    href="{{url('delete-product/'.$product->id)}}"
                                    class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection