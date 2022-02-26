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

    <div class="container" style="">
    <table class="table table-bordered table-hover">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">ID Libro</th>
            <th scope="col">Nombre Libro</th>
            <th scope="col">Nombre Usuario</th>
            <th scope="col">Correo Usuario</th>
            <th scope="col">Fecha Creación del Préstamo</th>
            <th scope="col">Fecha de devolución acordada</th>
            <th scope="col">Fecha de la devolución</th>
            <th scope="col">Días Atrasados devolución</th>
            <th scope="col">Observaciones</th>



        </tr>
        @foreach ($records as $record)

            @if($record->returned_date != null )
                <?php $color = "bg-warning text-dark"; ?>
            @else
                <?php $color = "bg-success text-dark"; ?>
            @endif

                @if($record->overdue_days != null )
                    <?php $colorLate = "bg-danger text-dark"; ?>
                @else
                    <?php $colorLate = ""; ?>
                @endif

            @if($record->loan_date != null )
                <?php $disabled = "none"; ?>
            @else
                <?php $disabled = ""; $color = "bg-primary text-white"; ?>
            @endif
                <?php $disable_borrrar = "";$texto_disabled =""; ?>
                @foreach ($fines as $fine)
                    @if($fine->loan_id == $record->id && $fine->fine_active == true)
                        <?php $disable_borrrar = "disabled";$texto_disabled="Eliminar deshabilitado, existe una penalización activa"; $color = "bg-dark text-white"?>

                    @endif
                @endforeach


            <tr class="{{ $color}}  ">
                <td>{{ $record->id }}</td>

                @foreach ($books as $book)
                    @if($record->book_id == $book->id)
                        <td>{{ $book->id }}</td>
                        <td>{{ $book->nombre }}</td>
                    @endif
                @endforeach
                @foreach ($users as $user)
                     @if($record->user_id == $user->id)
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                     @endif
                @endforeach
                <td>{{ $record->loan_date }}</td>
                <td>{{ $record->scheduled_returned_date }}</td>
                <td>{{ $record->returned_date }}</td>
                <td class="{{$colorLate}}">{{ $record->overdue_days }}</td>
                <td>{{ $record->observations }}</td>



                <td>

                    @if(@Auth::user()->hasRole('admin'))
                        <form action="{{ route('loans.update',$record->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <button style="display: {{ $disabled }}" onclick="return confirm('¿Estás seguro de Aceptar el préstamo? {{$record->id}}')" type="submit" class="btn btn-sm btn-success m-1">Aceptar</button>
                        </form>

                    <form action="{{ route('loans.destroy',$record->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <p> {{$texto_disabled}}</p>

                        <button  {{ $disable_borrrar }} onclick="return confirm('¿Estás seguro de rechazar el préstamo? {{$record->id}}')" type="submit" class="btn btn-sm btn-danger">Eliminar</button>

                    </form>
                        @if( $record->loan_date != null && $record->overdue_days != null && $record->returned_date !=null )
                          <!--   <a class="btn btn-sm btn-success m-1" href="/* route('fines.create',"id=".$record->id)*/ ">Crear Penalización</a> -->
                        @endif
                    @endif
                </td>

            </tr>

        @endforeach
    </table>
    </div>

@endsection

@section('footer')

@endsection
