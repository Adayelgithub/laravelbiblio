@extends('layout')

@section('content')


    <h2>Mis Préstamos:</h2>
    <table class="table table-bordered table-hover">
        <tr>
            <th scope="col">Nombre libro </th>
            <th scope="col">Fecha Creación del Préstamo</th>
            <th scope="col">Fecha de devolución acordada</th>
            <th scope="col">Fecha de la devolución</th>
            <th scope="col">Días Atrasados devolución</th>
            <th scope="col">Observaciones</th>
        </tr>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                @foreach($loans as $loan)
                    @if($loan->overdue_days != null )
                        <?php $color = "bg-danger text-dark"; ?>
                    @else
                        <?php $color = ""; ?>
                    @endif
                    @if($loan->loan_date != null && $loan->returned_date == null)
                    @if($loan->user_id == $user)
                        <tr>
                            @foreach ($books as $book)
                                @if($loan->book_id == $book->id)
                                    <td>{{ $book->nombre }}</td>
                                @endif
                            @endforeach
                            <td>{{ $loan->loan_date }}</td>
                            <td>{{ $loan->scheduled_returned_date }}</td>
                            <td>{{ $loan->returned_date }}</td>
                            <td class="{{$color}}">{{ $loan->overdue_days }}</td>
                            <td>{{ $loan->observations }}</td>
                            <td class="">
                             @if(@Auth::user()->hasRole('cliente'))
                                 <form action="{{ route('loans.update',$loan->id) }}" method="POST">



                                    @csrf
                                    @method('PUT')
                                     <button   type="submit" class="btn btn-sm btn-success m-1">Devolver Libro</button>
                                 </form>
                              @endif
                            </td>
                        </tr>
                    @endif
                    @endif

                @endforeach
            </div>
        </div>
    </div>



    </table>
    <a type="" class="btn btn-primary" href="{{ url('/books') }}">Return</a>
@endsection
