@extends('layout')

@section('content')
    <br>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Penalizaciones</h2>
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

    <div class="container" style="">
    <table class="table table-bordered table-hover">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">ID Usuario</th>
            <th scope="col">Nombre Usuario</th>
            <th scope="col">ID Préstamo</th>
            <th scope="col">Fecha creación penalización</th>
            <th scope="col">Fecha finalización de la penalización</th>
            <th scope="col">Estado Penalización </th>
            <th scope="col">Observaciones</th>



        </tr>
        @foreach ($records as $record)
            @if($record->fine_active == true )
                <?php $color = "bg-warning text-dark"; ?>
            @else
                <?php $color = ""; ?>
            @endif


            <tr class="  ">
                <td>{{ $record->id }}</td>
                @foreach ($users as $user)
                     @if($record->user_id == $user->id)
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                     @endif
                @endforeach
                @foreach ($loans as $loan)
                    @if($record->loan_id == $loan->id)
                        <td>{{ $loan->id }}</td>
                    @endif
                @endforeach
                <td>{{ $record->fine_start_date }}</td>
                <td>{{ $record->fine_end_date }}</td>
                @if($record->fine_active  == true)
                   <td class="{{ $color }}">ACTIVA</td>
                @else
                    <td>Finalizada</td>
                @endif
                <td>{{ $record->observations }}</td>



                <td>

                    @if(@Auth::user()->hasRole('admin'))
                    <form action="{{ route('fines.destroy',$record->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('¿Estás seguro de eliminar la penalización? {{$record->id}}')" type="submit" class="btn btn-sm btn-danger">Eliminar</button>
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
