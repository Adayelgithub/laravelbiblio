@extends('layout')
@section('content')

@if(@Auth::user()->hasRole('admin'))
    @if ($id = ($_REQUEST["id"]) ) @endif



    @foreach ($loans as $loan)
        @if($loan->id == $id && $loan->loan_date != null && $loan->overdue_days != null && $loan->returned_date !=null )
            @if ($id_user = $loan->user_id  ) @endif
            @if($current_date =  (date("Y-m-d H:i:s")))@endif
            @if($days_late = $loan->overdue_days )@endif
            @if( $fecha_fin_penalizacion = date('Y-m-d H:i:s', strtotime($current_date.' + '.$days_late.'days')) )@endif

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                @foreach ($users as $user)
                    @if($loan->user_id == $user->id)
                        <h1> Penalización a el usuario: {{ $user->name }} por el préstamo con id {{$loan->id}} </h1>
                    @endif
                @endforeach
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




    <form action="{{ route('fines.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input id="loan_id" name="loan_id" type="hidden" value="{{$loan->id}}">
        <input id="user_id" name="user_id" type="hidden" value="{{$id_user}}">
        <input id="fine_end_date" name="fine_end_date" type="hidden" value="{{$fecha_fin_penalizacion}}">
        @endif
        @endforeach
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <p> Días de retraso: <span class="border border-dark bg-danger" > {{$days_late}}  </span>  </p>
                <strong>Fecha fin de la penalización</strong>
                <h2 ><span class="border border-dark bg-success">  {{ $fecha_fin_penalizacion }} </span>  </h2>

            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Observaciones:</strong>
                <input type="text" name="observations"  class="form-control" placeholder="Observaciones">
            </div>
        </div>
        <input id="fine_active" name="fine_active" type="hidden" value="1">
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Crear penalización</button>
            </div>
        </div>

    </form>
    @endif
@endsection
