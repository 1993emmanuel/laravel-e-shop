@extends('layouts.admin')


@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Category Page</h4>
            <hr>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category )
                        <tr>
                            <td>{{$category->id}}</td>
                            <td>{{$category->name}}</td>
                            <td>{{$category->description}}</td>
                            <td>
                                <img
                                    class="cate-image"
                                    src="{{ asset('assets/uploads/category/'.$category->image) }}" alt="Image here">
                            </td>
                            <td>
                                <a 
                                    href="{{url('edit-prod/'.$category->id)}}"
                                    class="btn btn-primary">Edit</a>
                                <a 
                                    href="{{url('delete-category/'.$category->id)}}"
                                    class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection