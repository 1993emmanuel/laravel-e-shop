@extends('layouts.admin')


@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Add Category</h4>
        </div>
        <div class="card-body">
            <form action="{{url('insert-category')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name">Name</label>
                        <input 
                            type="text" name="name" id="name" class="form-control" placeholder="Ingresa nombre de la categoria">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="slug">Slug</label>
                        <input 
                            type="text" name="slug" id="slug" class="form-control" placeholder="Ingresa el slug de la categoria">
                    </div>
                    <div class="col-md-12 mb-3">
                        <textarea 
                            name="description" id="description" rows="3" 
                            class="form-control" placeholder="Ingresa la descripcion dela categoria"></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="status">Status</label>
                        <input type="checkbox" name="status" id="status">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="popular">Popular</label>
                        <input type="checkbox" name="popular" id="popular">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="meta_title">Meta Title</label>
                        <input 
                            type="text" name="meta_title" id="meta_title" 
                            class="form-control" placeholder="Ingresa el meta titulo de la categoria">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="meta_keywords">Meta KeyWords</label>
                        <input 
                            type="text" name="meta_keywords" id="meta_keywords" 
                            class="form-control" placeholder="Ingresa los meta keywords de la categoria">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="meta_descrip">Meta Description</label>
                        <textarea 
                            name="meta_descrip" id="meta_descrip" rows="3" 
                            class="form-control" placeholder="Inggresa la meta descripcion de la categoria"></textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <input 
                            type="file" name="image" id="image" 
                            class="form-control" placeholder="Carga una foto de la categoria">
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Guardar Categoria</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection