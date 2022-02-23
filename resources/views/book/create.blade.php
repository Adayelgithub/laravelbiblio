@extends('layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Añadir nuevo libro</h2>
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

    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nombre libro:</strong>
                <input type="text" name="nombre"  class="form-control" placeholder="Nombre libro">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Autor</strong>
                <input type="text" name="author"  class="form-control" placeholder="Autor libro">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Editorial</strong>
                <input type="text" name="publisher"  class="form-control" placeholder="Editorial libro">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="basicinput">Category</label>
            <div class="controls">
                <select tabindex="1" id="category" data-form-field="category" data-placeholder="Select category.." class="span8">
                    @foreach($categories_list as $category)
                        <option value="{{ $category->id }}">{{ $category->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <input id="available" name="available" type="hidden" value="1">
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Añadir Libro</button>
            </div>
        </div>

    </form>
@endsection
