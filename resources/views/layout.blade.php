<!DOCTYPE html>
<html>
<head>
    <title>Laravel 8 BIBLIOWEB</title>
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
</head>
<body>
<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-dark primary-color">
    <!-- Navbar brand -->
    <a class="navbar-brand" href="{{ url('/books') }}">BiblioWeb</a>
    <!-- Collapse button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
            aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Collapsible content -->
    <div class="collapse navbar-collapse" id="basicExampleNav">
        <!-- Links -->
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{ url('/books') }}">Inicio
                    <span class="sr-only">(current)</span>
                </a>
            </li>
            <!-- Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">Libros</a>
                <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="{{ url('/books') }}">Ver Todos Libros</a>
                    @if(@Auth::user()->hasRole('admin'))
                    <a class="dropdown-item" href="{{ url('/books/create') }}">Añadir nuevo libro </a>
                    @endif
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">Categorias</a>
                <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="{{ url('/categories') }}">Ver Categorias </a>
                    @if(@Auth::user()->hasRole('admin'))
                    <a class="dropdown-item" href="{{ url('/categories/create') }}">Añadir nueva Categoría </a>
                    @endif
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">Préstamos</a>
                <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                    @if(@Auth::user()->hasRole('admin'))
                        <a class="dropdown-item" href="{{ url('/loans') }}">Ver Préstamos </a>
                    @endif

                    @if(@Auth::user()->hasRole('admin'))

                    @endif
                </div>
            </li>

            @auth()
                <li class="nav-item dropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endauth


                <div class="d-flex justify-content-end" >
                    <p class="rounded bg-info">Usuario: <span  class="text-warning">{{@Auth::user()->name }}</span> </p>
                    @if(@Auth::user()->hasRole('cliente'))
                     <p class="rounded bg-info"> Rol Actual: <span  class="text-warning"> Cliente </span> </p>
                    @endif
                    @if(@Auth::user()->hasRole('admin'))
                        <p class="rounded bg-info"> Rol Actual:<span  class="text-warning">  Administrador </span></p>
                    @endif
                </div>


        </ul>
        <!-- Links -->
    </div>
    <!-- Collapsible content -->
</nav>
<!--/.Navbar-->
<div class="container">
    @yield('content')
</div>
<div class="d-flex justify-content-center">
    @yield('footer')
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
</body>
</html>
