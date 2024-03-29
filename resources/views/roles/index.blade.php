@extends('layouts.dash')

@section('content')
<!--Modal edit Role-->
@foreach($roles as $role)
<div class="modal fade bd-editar-role{{$role->id}}" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Editar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
{!! Form::model($role, ['method' => 'PUT','route' => ['roles.update', $role->id]]) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            <input placeholder="Name" class="form-control" name="name" type="text" value="{{ $role->name }}" disabled>
            {{ Form::hidden('name', $role->name) }}

        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Permission:</strong>
            <br/>
            @foreach($permissions as $permission)
            <label>
                @if($role->name != 'Admin')
                    @if($permission->name == 'roles.roles')
                    <input type="checkbox" name="permission[]" value="{{ $permission->id }}" disabled="">
                    {{ $permission->name }}
                    @else
                    <input type="checkbox" name="permission[]" value="{{ $permission->id }}" @if($role->permissions->contains($permission)) checked @endif>
                    {{ $permission->name }}
                    @endif
                @else
                <input type="checkbox" name="permission[]" value="{{ $permission->id }}" @if($role->permissions->contains($permission)) checked @endif>
                    {{ $permission->name }}
                @endif
            </label>
            <br/>
            @endforeach
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Ok</button>
    </div>
</div>
{!! Form::close() !!}

      </div>
    </div>
  </div>
</div>
@endforeach

<!--Modal Permission destroy-->
  @foreach($permissions as $permission)
  <div class="modal fade bd-destroy-permission{{$permission->id}}" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Borrar</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            {!! Form::open(['route' => ['roles.destroypermission', $permission->id], 'method' => 'DELETE', 'onsubmit' => 'return validate_delete()']) !!}
              <div class="form-group">
                <label>Borraras el permiso {{$permission->name}}</label>
              </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                  <button type="submit" class="btn btn-danger">Borrar</button>
                </div>                           
            {!! Form::close() !!}
          </div>
        </div>
      </div>
  </div>
  @endforeach 

<!--Modal Role destroy-->
  @foreach($roles as $role)
  <div class="modal fade bd-destroy-role{{$role->id}}" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Borrar</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            {!! Form::open(['route' => ['roles.destroy', $role->id], 'method' => 'DELETE']) !!}
              <div class="form-group">
                <label>Borraras el permiso {{$role->name}}</label>
              </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                  <button type="submit" class="btn btn-danger">Borrar</button>
                </div>                           
            {!! Form::close() !!}
          </div>
        </div>
      </div>
  </div>
  @endforeach 

<!--Modal edit User Role-->
@foreach($users as $user)
<div class="modal fade bd-editar-user-role{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Editar Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
{!! Form::model($user, ['method' => 'PUT','route' => ['roles.assignrole', $user->id]]) !!}

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Role:</strong><br>
            @foreach($roles as $role)
            <label>
            {{ Form::checkbox('roles[]', $role->id, null) }}
            {{ $role->name }}
            </label><br>
            @endforeach
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Ok</button>
    </div>

</div>

{!! Form::close() !!}

      </div>
    </div>
  </div>
</div>
@endforeach

<!--Modal Create role-->
  <div class="modal fade bd-create-role" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Crear nuevo rol</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

{!! Form::open(['route' => 'roles.store']) !!}
        @csrf

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            <input type="text" placeholder="nombre rol" name="name" class="form-control">

        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Permission:</strong>
            <br/>
                @foreach($permissions as $permission)
                
                    <label>{{ Form::checkbox('permission[]', $permission->id, false, array('class' => 'name')) }} {{ $permission->name }}
                    </label>
                <br>
                @endforeach
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>



          </div>
        </div>
      </div>
  </div>
{!! Form::close() !!}

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom" id="_role_">
  <h1 class="h2">Roles y Permisos</h1>
</div>

<div class="container">
  <div class="card-deck mb-3 text-center">
    <div class="card mb-4 shadow-sm">
      <div class="card-body">
        <button type="button" class="btn btn-lg btn-block btn-outline-primary" data-toggle="modal" data-target=".bd-create-role"><i class="fa fa-plus"></i> Agregar nuevo Rol</button></span>
      </div>
      <div class="card-header">
        @foreach($roles as $role)
        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
            <h6 class="my-0 text-left">{{ $role->name }}: 
              <br>
              @forelse ($role->permissions as $permission)
                  <small class="text-muted">{{ $permission->name }}</small>
              @empty
                  <small class="text-muted">sin permisos</small>
              @endforelse
            </h6>
          </div>
            <div class="btn-group" role="group" aria-label="Basic example">
                  <button type="button" class="btn btn-info  btn-sm" data-toggle="modal" data-target=".bd-editar-role{{$role->id}}"><i class="fa fa-edit"></i></button>
                  @if($role->name == 'Admin')
                    <button type="button" class="btn btn-secondary  btn-sm" disabled><i class="fa fa-trash"></i></button>
                  @else
                  <button type="button" class="btn btn-danger  btn-sm" data-toggle="modal" data-target=".bd-destroy-role{{$role->id}}"><i class="fa fa-trash"></i></button>
                  @endif
            </div>
        </li>
        @endforeach
      </div>
      
    </div>
    
    <div class="card mb-4 shadow-sm">
      <div class="card-body">
        {!! Form::open(['route' => 'roles.storepermission']) !!}
        @csrf
        <div class="input-group">
          <input type="text" class="form-control" name="name" placeholder="Agregar Permiso">
          <div class="input-group-append">
            <button type="submit" class="btn btn-primary">Ok</button>
          </div>
        </div>
        {!! Form::close() !!}
      </div>
      <div class="card-header">
        @foreach($permissions as $permission)
        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
            <h6 class="my-0 text-left">{{ $permission->name }}
            <small class="text-muted ">{{ $permission->guard_name }}</small>
            </h6>
          </div>
          <div class="btn-group" role="group" aria-label="Basic example">
                  
                  @if($permission->name == 'roles.roles')
                  <button type="button" class="btn btn-danger btn-sm" disabled><i class="fa fa-trash"></i></button>
                  @else
                  <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target=".bd-destroy-permission{{$permission->id}}"><i class="fa fa-trash"></i></button>
                  @endif
            </div>
        </li>
        @endforeach
      </div>
    </div>
  </div>
@endsection