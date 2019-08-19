@extends('layouts.app')

@section('content')
    <div class="container">
    @if (count($errors) > 0)
        
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          @foreach ($errors->all() as $error)
          <p class="mb-0"><strong>{{ $error }}</strong></p>
          @endforeach
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
    @endif
    @if (session('info'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <p class="mb-0"><strong>{{ session('info') }}</strong></p>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
    @endif

<!--Modal edit Role-->
@foreach($roles as $role)
<div class="modal fade bd-editar-role{{$role->id}}" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
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
                {{-- {{ Form::checkbox('permission[]', $permission->id, in_array($permission->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                {{ $permission->name }} --}}
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
  <div class="modal-dialog modal-xl">
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
      <div class="modal-dialog modal-xl">
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
  <div class="row">
    <div class="col-md-4 order-md-2 mb-4">
      <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">Lista de Roles <button type="button" class="btn btn-success" data-toggle="modal" data-target=".bd-create-role"><i class="fa fa-plus"></i></button></span>
        <label class="badge badge-info">{{ $total_roles }}</label>
      </h4>
      <ul class="list-group mb-3">
        @foreach($roles as $role)
        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
            <h6 class="my-0">{{ $role->name }}</h6>
            <small class="text-muted">{{ $role->guard_name }}</small>
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
      </ul>
    <br> 
      <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">Lista de Permisos </span>
        @if (empty($total_permissions))
        <span class="badge badge-secondary badge-pill">Vacio</span>
        @else
        <label class="badge badge-info">{{ $total_permissions }}</label>
        @endif
      </h4>
      <ul class="list-group mb-3">
        @foreach($permissions as $permission)
        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
            <h6 class="my-0">{{ $permission->name }}</h6>
            <small class="text-muted">{{ $permission->guard_name }}</small>
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
      </ul>

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

    <div class="col-md-8 order-md-1">
        <h4 class="mb-3 ">Tabla de usuarios del sistema</h4>

      {{ Form::open(['route' => 'roles.index', 'method' => 'GET']) }}
        <div class="input-group">
        <input type="text" class="form-control" placeholder="busqueda de usuarios" name="busqueda">
          <div class="input-group-append">
            <button type="submit" class="btn btn-secondary"><i class="fa fa-search"></i></button>
          </div>
        </div>
      {{ Form::close() }}

      <br>
        <table class="table table-striped">

          <tbody>
            @foreach($users as $user)
            <tr>
              <th scope="row">
                
                @if($user->profile_image == null)
                <img src="{{ asset('uploads/images/generic.png') }}" style="width: 30px; height: 30px; border-radius: 50%;">
                @else
                <img src="{{ asset($user->profile_image) }}" style="width: 30px; height: 30px; border-radius: 50%;">
                @endif
                {{ $user->name }}

              </th>
              <td>{{ $user->email }}</td>
              <td>      
                @if(!empty($user->getRoleNames()))
                    @foreach($user->getRoleNames() as $role)
                        <label class="badge badge-info">{{ $role }}</label><br>
                    @endforeach
                @endif
              </td>
              <td>
                  <div class="btn-group" role="group" aria-label="Basic example">
                  <button type="button" class="btn btn-info  btn-sm" data-toggle="modal" data-target=".bd-editar-user-role{{$user->id}}"><i class="fa fa-edit"></i></button>
                  <button type="button" class="btn btn-secondary  btn-sm" disabled><i class="fa fa-ban"></i></button>
                    </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {{$users->appends(Request::all())->links()}}
      
    </div>
  </div>
</div>
@endsection