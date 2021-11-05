@extends('layouts.admin')


@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Edit Category</h4>
        </div>
        <div class="card-body">
            <form action="{{url('update-category',$category->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name">Name</label>
                        <input 
                            type="text" name="name" id="name" class="form-control" 
                            placeholder="Ingresa nombre de la categoria" value="{{$category->name}}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="slug">Slug</label>
                        <input 
                            type="text" name="slug" id="slug" class="form-control" 
                            placeholder="Ingresa el slug de la categoria" value="{{$category->slug}}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <textarea 
                            name="description" id="description" rows="3" 
                            class="form-control" placeholder="Ingresa la descripcion dela categoria">{{$category->description}}</textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="status">Status</label>
                        <input type="checkbox" name="status" id="status" {{ $category->status == "1" ? 'checked' : '' }}>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="popular">Popular</label>
                        <input type="checkbox" name="popular" id="popular" {{$category->popular == '1' ? 'checked' : ''}}>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="meta_title">Meta Title</label>
                        <input 
                            type="text" name="meta_title" id="meta_title" value="{{$category->meta_title}}"
                            class="form-control" placeholder="Ingresa el meta titulo de la categoria">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="meta_keywords">Meta KeyWords</label>
                        <input 
                            type="text" name="meta_keywords" id="meta_keywords" value="{{$category->meta_keywords}}"
                            class="form-control" placeholder="Ingresa los meta keywords de la categoria">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="meta_descrip">Meta Description</label>
                        <textarea 
                            name="meta_descrip" id="meta_descrip" rows="3" 
                            class="form-control" placeholder="Inggresa la meta descripcion de la categoria">{{$category->meta_descrip}}</textarea>
                    </div>
                    @if ($category->image)
                        <img src="{{ asset('assets/uploads/category/'.$category->image) }}" alt="Category Image">
                    @endif
                    <div class="col-md-12 mb-3">
                        <input 
                            type="file" name="image" id="image" 
                            class="form-control" placeholder="Carga una foto de la categoria">
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Editar Categoria</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection