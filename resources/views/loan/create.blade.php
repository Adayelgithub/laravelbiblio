@extends('layout')
@section('content')

    @if ($id = ($_REQUEST["id"]) ) @endif



    @foreach ($books as $book)
        @if($book->id == $id && $book->available == 1)
            @if ($id_libro = $book->id  ) @endif
            @if ($nombr_libro = $book->nombre ) @endif

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Solicitar Préstamo libro ( {{$nombr_libro}}  )</h2>
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




    <form action="{{ route('loans.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input id="book_id" name="book_id" type="hidden" value="{{$id_libro}}">
        <input id="user_id" name="user_id" type="hidden" value="{{Auth::user()->id}}">
        @endif
        @endforeach
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Fecha de devolución: Máximo 5 días </strong>
                <input type="date" name="scheduled_returned_date"  class="form-control" placeholder="Fecha de devolución">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Observaciones:</strong>
                <input type="text" name="observations"  class="form-control" placeholder="Observaciones">
            </div>
        </div>

        <input id="available" name="available" type="hidden" value="1">
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Hacer solicitud préstamo</button>
            </div>
        </div>

    </form>
@endsection
