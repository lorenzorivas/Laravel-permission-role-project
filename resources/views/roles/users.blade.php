@extends('layouts.dash')

@section('content')
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


<!--Modal import-->
<div class="modal fade bd-import" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Importar excel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<form action="{{ route('users.import') }}" method="POST" enctype="multipart/form-data" class="was-validated">
@csrf
  <div class="custom-file">
    <input type="file" name="file" class="custom-file-input" id="validatedCustomFile" required>
    <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
  </div>
  <br>
  <br>
<button type="submit" class="btn btn-info btn-lg btn-block btn-sm">Subir</button>
</form>

      </div>
    </div>
  </div>
</div>
<!--fin modal import-->
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom" id="_user_">
  <h1 class="h2">Lista de usuarios</h1>
  <div class="btn-toolbar mb-2 mb-md-0">

    <div class="btn-group mr-2">
      @if (count($errors) > 0)
          @foreach ($errors->all() as $error)
          <button type="button" class="btn btn-sm btn-outline-danger"><i class="fa fa-exclamation"></i> {{ $error }} </button>
          @endforeach
    @endif
    @if (session('info'))
         <button type="button" class="btn btn-sm btn-outline-success"><i class="fa fa-check-circle"></i> {{ session('info') }}</button>
    @endif
      <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target=".bd-import"><i class="fa fa-upload"></i></button>
      <button type="button" class="btn btn-sm btn-outline-secondary"><a style="text-decoration: none;" href="{{ route('users.export') }}"><i class="fa fa-download"></i></a></button>
    </div>
  </div>
</div>

        {{ Form::open(['route' => 'users.index', 'method' => 'GET']) }}
        <div class="input-group">
        <input type="text" class="form-control" placeholder="busqueda de usuarios" name="busqueda">
          <div class="input-group-append">
            <button type="submit" class="btn btn-secondary"><i class="fa fa-search"></i></button>
          </div>
        </div>
      {{ Form::close() }}
    <br>
<div class="table-responsive">
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
@endsection