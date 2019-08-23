@extends('layouts.dash')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom" id="_user_">
  <h1 class="h2">Lista de tareas</h1>
  <div class="btn-toolbar mb-2 mb-md-0">
    <div class="btn-group mr-2">
      <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
      <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
    </div>
    <div class="progress">
      @if(number_format($percentage) == 100)
      <div class="progress-bar bg-success" role="progressbar" style="width: {{ $percentage }}%" aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100">{{number_format($percentage)}}%  tareas completadas</div>
      @else
      <div class="progress-bar bg-info progress-bar-striped progress-bar-animated" role="progressbar" style="width: {{ $percentage }}%" aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100">{{number_format($percentage)}}% tareas completadas</div>
      @endif
    </div>
  </div>
</div>
{{ Form::open(['route' => 'role.task', 'method' => 'GET']) }}
  <div class="input-group">
  <input type="text" class="form-control" placeholder="ingresa una búsqueda" name="busqueda">
  <select class="custom-select" name="user">
    <option selected value="">Busca por usuario</option>
        @foreach($users as $user)
        <option value="{{$user->id}}">{{$user->name}} [{{ $user->id }}]</option>
        @endforeach
    </select>
    <div class="input-group-append">
      <button type="submit" class="btn btn-secondary"><i class="fa fa-search"></i></button>
    </div>
  </div>
{{ Form::close() }}
<br>
<div class="table-responsive">
  <table class="table table-striped">
    <tbody>
      @foreach($tasks as $task)
      <tr>
        <th scope="row">
          	{{ $task->user->name }}
        </th>
        <td>
        	@if ($task->is_complete)
              	<span class="text-muted">{{ $task->title }}</span>
           	@else
               	{{ $task->title }}
           	@endif
        </td>
        <td>      
          @if (! $task->is_complete)
          {!! Form::model($tasks, ['route' => ['task.update', $task->id], 'method' => 'PUT']) !!}
              <button type="submit" class="btn btn-info btn-sm center rounded-0"><i class="fa fa-check "></i> Completar</button>
          {!! Form::close() !!}
          @else
          {!! Form::model($tasks, ['route' => ['task.develop', $task->id], 'method' => 'PUT']) !!}
              <button type="submit" class="btn btn-danger btn-sm center rounded-0"><i class="fa fa-cog "></i> Desarrollar</button>
          {!! Form::close() !!}
          @endif
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  {{$tasks->appends(Request::all())->links()}}
</div>
@endsection