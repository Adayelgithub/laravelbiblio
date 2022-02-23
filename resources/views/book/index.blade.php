@extends('layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Libros</h2>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Autor</th>
            <th>Editorial</th>

        </tr>
        @foreach ($records as $record)
            <tr>
                <td> {{ $record->id }}</td>
                <td>{{ $record->nombre }}</td>
                <td>{{ $record->author }}</td>
                <td>{{ $record->publisher }}</td>

                <td class="d-flex">
                    <a class="btn btn-sm btn-info m-1" href="{{ route('books.show',$record->id) }}">Show</a>
                    <a class="btn btn-sm btn-primary m-1" href="{{ route('books.edit',$record->id) }}">Edit</a>
                    <form action="{{ route('books.destroy',$record->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

@endsection
