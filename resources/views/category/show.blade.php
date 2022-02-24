@extends('layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Información de la categoría: {{ $category->id }} {{ $category->nombre }}</h2>
            </div>        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nombre:</strong>
                {{ $category->nombre }}
            </div>
        </div>
    </div>
    <h3>Libros de la categoría actual</h3>
    <table class="table table-bordered table-hover">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre</th>
            <th scope="col">Autor</th>
            <th scope="col">Editorial</th>
        </tr>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                @foreach($books as $book)
                    @if($book->category->nombre == $category->nombre)
                        <tr>
                            <td>{{ $book->id }}</td>
                            <td>{{ $book->nombre }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ $book->publisher }}</td>
                        </tr>
                    @endif

                @endforeach
            </div>
        </div>
    </div>



    </table>
    <a type="" class="btn btn-primary" href="{{ url('/categories') }}">Return</a>
@endsection
