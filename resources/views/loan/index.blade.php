@extends('layout')

@section('content')
    <br>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Categorías</h2>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if ($message = Session::get('error'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="container">
    <table class="table table-bordered table-hover">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre</th>
        </tr>
        @foreach ($records as $record)
            <tr>
                <td>{{ $record->id }}</td>
                <td>{{ $record->nombre }}</td>

                <td class="d-flex">
                    <a class="btn btn-sm btn-info m-1" href="{{ route('categories.show',$record->id) }}">Show</a>
                    @if(@Auth::user()->hasRole('admin'))
                    <a class="btn btn-sm btn-primary m-1" href="{{ route('categories.edit',$record->id) }}">Edit</a>
                    <form action="{{ route('categories.destroy',$record->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('¿Estás seguro de eliminar la categoría? {{$record->nombre}}')" type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                    @endif
                </td>

            </tr>
        @endforeach
    </table>
    </div>

@endsection

@section('footer')

@endsection
