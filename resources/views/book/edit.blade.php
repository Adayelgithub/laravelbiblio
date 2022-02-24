@extends('layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Libro</h2>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('books.update',$book->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nombre libro:</strong>
                    <input type="text" name="nombre" value="{{ $book->nombre }}" class="form-control" placeholder="Nombre libro">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Autor</strong>
                    <input type="text" name="author" value="{{ $book->author }}" class="form-control" placeholder="Autor libro">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Editorial</strong>
                    <input type="text" name="publisher" value="{{ $book->publisher }}" class="form-control" placeholder="Editorial libro">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Editorial</strong>
                    <input type="text" name="publisher" value="{{ $book->publisher }}" class="form-control" placeholder="Editorial libro">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <label class="control-label" for="basicinput"><strong>Categoría</strong></label>
                <div class="controls">
                    <select class="form-select" tabindex="1"  name="category_id"  id="category" data-form-field="category" data-placeholder="Select category.." class="span8">
                        @foreach($categories_list as $category)
                            @if($book->category->nombre == $category->nombre)
                                {{ $select = "selected" }}
                             @else
                                {{ $select = "" }}
                            @endif
                            <option {{$select}} value="{{ $category->id }}">{{ $category->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Actualizar Libro</button>
            </div>
        </div>
    </form>
@endsection
