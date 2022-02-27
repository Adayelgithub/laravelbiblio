@extends('layout')

@section('content')
    <?php $penalizado = false  ?>

    @foreach ($fines as $fine)
        @if($fine->user_id == @Auth::user()->id  && $fine->fine_active == true)
            <?php $penalizado = true  ?>
        @endif
    @endforeach
    <br>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Libros</h2>
            </div>
        </div>
    </div>

    @if ($message = Session::get('error'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>

    @endif

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
    <p> Máximo 2 Solicitudes de préstamo</p>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    @if($penalizado == true)
    <p class="bg-danger text-black text-center"> Actualmente Penalizado, no puede solicitar libros</p>
    @endif


    <div class="container">
    <table class="table table-responsive-lg table-bordered table-hover">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre</th>
            <th scope="col">Autor</th>
            <th scope="col">Editorial</th>
            <th scope="col">Categoria</th>
            @if(@Auth::user()->hasRole('admin'))
             <th scope="col">Disponibilidad libro</th>
            @endif


        </tr>
        @foreach ($records as $record)
            <?php $count = 0;$disable_borrrar = ""; $texto_disable = "" ?>
                @foreach ($loans as $loan)
                    @if($loan->user_id == @Auth::user()->id && $loan->returned_date == null )
                        <?php $count++  ?>
                        @if( $count >= 2)
                                <?php   $disable_borrrar = "none"; $texto_disable ="Ya ha realizado las 2 solicitudes";?>
                        @endif
                    @endif
                @endforeach





            <tr>
                <td>{{ $record->id }}</td>
                <td>{{ $record->nombre }}</td>
                <td>{{ $record->author }}</td>
                <td>{{ $record->publisher }}</td>
                <td>{{ $record->category->nombre }}</td>
                @if(@Auth::user()->hasRole('admin'))
                    @if( $record->available == true)
                        <td class="text-dark bg-success"> Disponible</td>
                    @else
                        <td class="text-dark bg-danger"> No Disponible</td>
                    @endif
                @endif

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
                    <?php $loans_counter = 0; ?>
                    @if(@Auth::user()->hasRole('cliente') && $record->available == 1 && $penalizado == false )
                        <?php $disabled = ""; $texto_cantidad ="Solicitar Préstamo"; ?>
                        @foreach ($loans as $loan)
                            @if($loan->user_id == @Auth::user()->id &&  $loan->book_id == $record->id && $loan->returned_date == null )
                                    <?php   $disabled = "disabled";$texto_cantidad="Solicitud ya realizada";?>
                                @else
                                    <?php   $disabled = ""; $texto_cantidad ="Solicitar Préstamo";?>
                            @endif
                        @endforeach
                            @foreach ($loans as $loan)
                                @if($loan->user_id == @Auth::user()->id && $loan->returned_date == null && $loan->overdue_days != null )
                                    <?php   $disabled = "disabled"; $texto_cantidad="Tienes un libro sin entregar";?>
                                @endif
                            @endforeach
                        @if($disabled != "")
                                 <button style="display: {{$disable_borrrar}}"  class="btn btn-sm btn-success m-1" {{ $disabled }}> {{ $texto_cantidad }}</button>
                            @else
                                <a   href="{{ route('loans.create',"id=".$record->id) }}"> <button style="display: {{$disable_borrrar}}"  class="btn btn-sm btn-success m-1" {{ $disabled }}> {{ $texto_cantidad }}</button></a>
                            @endif
                    @endif
                </td>
            </tr>

        @endforeach
        <p class="bg-success text-black text-center">{{$texto_disable}}</p>
    </table>
    </div>

@endsection

@section('footer')
    {{$records->links()}}
@endsection
