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


<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom" id="_user_">
  <h1 class="h2">Lista de usuarios</h1>
  <div class="btn-toolbar mb-2 mb-md-0">
    <div class="btn-group mr-2">
      <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
      <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
    </div>
    <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
      <span data-feather="calendar"></span>
      This week
    </button>
  </div>
</div>

        {{ Form::open(['route' => 'roles.index', 'method' => 'GET']) }}
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