@extends('layout')

@section('content')


    <h2>Mis Penalizaciones Activas:</h2>
    <table class="table table-bordered table-hover">
        <tr>

            <th scope="col">Fecha Comienzo Penalización</th>
            <th scope="col">Fecha FIN Penalización</th>
            <th scope="col">Observaciones</th>
        </tr>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                @foreach($fines as $fine)
                    @if($fine->user_id == $user && $fine->fine_active == true)
                        <tr>
                            <td>{{ $fine->fine_start_date }}</td>
                            <td>{{ $fine->fine_end_date }}</td>
                            <td>{{ $fine->observations }}</td>
                        </tr>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    </table>
    <a type="" class="btn btn-primary" href="{{ url('/books') }}">Return</a>
@endsection
