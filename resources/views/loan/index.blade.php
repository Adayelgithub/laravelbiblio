@extends('layout')

@section('content')
    <br>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Préstamos</h2>
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
            <th scope="col">ID Libro</th>
            <th scope="col">ID Usuario</th>
            <th scope="col">Fecha Creación del Préstamo</th>
            <th scope="col">Fecha de devolución acordada</th>
            <th scope="col">Fecha de la devolución</th>
            <th scope="col">Días Atrasados</th>
            <th scope="col">Observaciones</th>

        </tr>
        @foreach ($records as $record)
            <tr>
                <td>{{ $record->book_id }}</td>
                <td>{{ $record->user_id }}</td>
                <td>{{ $record->loan_date }}</td>
                <td>{{ $record->scheduled_returned_date }}</td>
                <td>{{ $record->returned_date }}</td>
                <td>{{ $record->overdue_days }}</td>
                <td>{{ $record->observations }}</td>




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
