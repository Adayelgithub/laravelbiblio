@extends('layout')

@section('content')
    <br>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Libros</h2>
            </div>
        </div>
    </div>

    <form method="POST" action="{{'/'}}">
        @csrf
        <div class="container d-flex justify-content-center pb-5">
            <div class="col-6">
                <input class="form-control" name="text" type="text" placeholder="buscar por el nombre">
            </div>
            <div class="col-1">
                <button  class="btn btn-primary" type="submit">Buscar</button>
            </div>

        </div>
    </form>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>

    @endif

    <div class="container">
    <table class="table table-bordered table-hover">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre</th>
            <th scope="col">Autor</th>
            <th scope="col">Editorial</th>
            <th scope="col">Categoria</th>

        </tr>
        @foreach ($records as $record)
            <tr>
                <td>{{ $record->id }}</td>
                <td>{{ $record->nombre }}</td>
                <td>{{ $record->author }}</td>
                <td>{{ $record->publisher }}</td>
                <td>{{ $record->category->nombre }}</td>

                <td class="d-flex">
                    <a class="btn btn-sm btn-info m-1" href="{{ route('books.show',$record->id) }}">Show</a>

                    @if(@Auth::user()->hasRole('admin'))

                    <a class="btn btn-sm btn-primary m-1" href="{{ route('books.edit',$record->id) }}">Edit</a>
                    <form action="{{ route('books.destroy',$record->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('¿Estás seguro de eliminar el libro? {{$record->nombre}}')" type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>

                    @endif
                    @if(@Auth::user()->hasRole('cliente') && $record->available == 1 )
                        <a class="btn btn-sm btn-success m-1" href="{{ route('loans.create',"id=".$record->id) }}">Solicitar Préstamo</a>
                    @endif
                </td>
            </tr>

        @endforeach

    </table>
    </div>

@endsection

@section('footer')
    {{$records->links()}}
@endsection
