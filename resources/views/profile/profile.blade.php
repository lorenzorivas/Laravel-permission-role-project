@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    @if (session('status'))
                    <div class="card-header bg-info text-light">
                        {{ session('status') }}
                    </div>
                    @else
                    <div class="card-header">
                        Perfil
                    </div>
                    @endif
                    <div class="card-body">

                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    @if ($errors->any())
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>
                                                        {{ $error }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form action="{{ route('profile.update') }}" method="POST" role="form" enctype="multipart/form-data">
                                        @csrf
                                        {{ Form::hidden('image', auth()->user()->image) }}
                                        <div class="form-group row">
                                            <label for="name" class="col-md-4 col-form-label text-md-right">Nombre</label>
                                            <div class="col-md-6">
                                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name', auth()->user()->name) }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                                            <div class="col-md-6">
                                                <input id="email" type="text" class="form-control" name="email" value="{{ old('email', auth()->user()->email) }}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-4 col-form-label text-md-right">Rol</label>
                                            <div class="col-md-6">
                                                @if (Auth::user()->roles->first())
                                                <input type="text" class="form-control" disabled="" value="{{ Auth::user()->roles->first()->name }}">
                                                @else
                                                <input type="text" class="form-control" disabled="" value="Aún no tienes un rol, contacta al Admin">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="profile_image" class="col-md-4 col-form-label text-md-right">Imagen de Perfil</label>
                                            <div class="col-md-6">
                                                <input class="btn btn--dark btn--large btn--block" id="profile_image" type="file" class="form-control" name="profile_image">
                                                <br>
                                                @if (auth()->user()->image)
                                                    <code>{{ auth()->user()->image }}</code>
                                                @endif
                                            </div>
                                            @if (auth()->user()->image)
                                            <img src="{{ asset(auth()->user()->image) }}" style="width: 80px; height: 80px; border-radius: 50%;">
                                            @endif
                                        </div>

                                        <div class="form-group row mb-0 mt-5">
                                            <div class="col-md-8 offset-md-4">
                                                <button type="submit" class="btn btn-info">Actualizar</button>
                                            </div>
                                        </div>
                                    </form>
				    <a class="nav-link text-danger" href="{{ url('/changepassword') }}"><i class="fa fa-key"></i> Cambiar password</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>


@endsection
