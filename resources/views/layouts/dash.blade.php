<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Panel de Administración</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/dashboard/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.3/examples/dashboard/dashboard.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
  <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
  <ul class="navbar-nav px-3">
    <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
        @if (auth()->user()->image)
        <img src="{{ asset(auth()->user()->image) }}" style="width: 20px; height: 20px; border-radius: 50%;">
        @else
        <img src="{{ asset('uploads/images/generic.png') }}" style="width: 20px; height: 20px; border-radius: 50%;">
        @endif
        {{ Auth::user()->name }} <span class="caret"></span>
        </a>

        <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                <i class="fa fa-sign-out-alt"></i> {{ __('Logout') }}
            </a>

            <a class="dropdown-item" href="{{ url('/profile') }}">Mi perfil</a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </li>
  </ul>
</nav>

<div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block bg-dark sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link text-light" href="#">
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="{{ url('/roles') }}">
              <i class="fa fa-{{ (request()->routeIs('roles.index')) ? 'chevron-circle-right' : '' }}"></i>
              Roles y permisos
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="{{ url('/users') }}">
              <i class="fa fa-{{ (request()->routeIs('users.index')) ? 'chevron-circle-right' : '' }}"></i>
              usuarios
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="{{ url('/activity') }}">
              <i class="fa fa-{{ (request()->routeIs('activity.index')) ? 'chevron-circle-right' : '' }}"></i>
              Actividad usuarios
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="{{ url('/admin_task') }}">
              <i class="fa fa-{{ (request()->routeIs('role.task')) ? 'chevron-circle-right' : '' }}"></i>
              Tareas
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="#">
              <span data-feather="layers"></span>
              disponible
            </a>
          </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Nueva sección</span>
          <a class="d-flex align-items-center text-muted" href="#">
            <span data-feather="plus-circle"></span>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link text-light" href="#">
              <span data-feather="file-text"></span>
              disponible
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="#">
              <span data-feather="file-text"></span>
              disponible
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="#">
              <span data-feather="file-text"></span>
              disponible
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="#">
              <span data-feather="file-text"></span>
              disponible
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      @yield('content')
    </main>
  </div>
</div>
@yield('scripts')
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
      </body>
</html>