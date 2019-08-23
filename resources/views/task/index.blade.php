@extends('layouts.app')

@section('content')

<div class="container">

  <div class="row">
    <div class="col-md-4 order-md-2 mb-4">
      
      <h4 class="d-flex justify-content-between align-items-center mb-3 bg-info p-3">
        
        @if (count($errors) > 0)
             @foreach ($errors->all() as $error)
             <span class="text-dark">{{ $error }}</span>
             @endforeach
        @elseif (session('info'))
          <span class="text-light">{{ session('info') }}</span>
        @else
                <span class="text-light">Agregar tarea</span>
        @endif
      </h4>
      {!! Form::open(['route' => 'task.store']) !!}
      <ul class="list-group mb-3">
        <div class="input-group">
              {{ Form::hidden('user_id', auth()->user()->id) }}
              <input type="text" class="form-control" placeholder="nombre" name="title">
              <div class="input-group-append">
              <button type="submit" class="btn btn-info">Guardar</button>
              </div>
      </div>
      </ul>
      {!! Form::close() !!}
      <div class="progress">
        @if(number_format($percentage) == 100)
        <div class="progress-bar bg-success" role="progressbar" style="width: {{ $percentage }}%" aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100">{{number_format($percentage)}}%</div>
        @else
        <div class="progress-bar bg-info progress-bar-striped progress-bar-animated" role="progressbar" style="width: {{ $percentage }}%" aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100">{{number_format($percentage)}}%</div>
        @endif
      </div>
      <h6 class="d-flex justify-content-between align-items-center mb-3">
        @if(number_format($percentage) == 100)
        <span class="text-muted">Has completado todas tus {{$tasks_complete}} tareas. Sigue así!</span>
        @elseif($percentage == 0)
        <span class="text-muted">Aún no tienes tareas registradas.</span>
        @else
        <span class="text-muted"><b>{{$tasks_complete}}</b> de {{$total_task}} tareas completadas.</span>
        @endif
      </h6> 
    </div>
    <div class="col-md-8 order-md-1">

{{ Form::open(['route' => 'task.index', 'method' => 'GET']) }}
  <div class="input-group">
  <input type="text" class="form-control" placeholder="ingresa una búsqueda" name="busqueda">
    <div class="input-group-append">
      <button type="submit" class="btn btn-secondary"><i class="fa fa-search"></i></button>
    </div>
  </div>
{{ Form::close() }}
<br>

      <div class="table-responsive">
        <table class="table table-striped table-sm">
        {{--<thead>
            <tr>
              <th>Nombre</th>
              <th>Estado</th>
            </tr>
          </thead> --}}
          <tbody>
            @foreach($tasks as $task)
            <tr>
                <td>
                   @if ($task->is_complete)
                      <span class="text-muted">{{ $task->title }}</span>
                   @else
                       {{ $task->title }}
                   @endif
               </td>
               <td class="text-right">
                  @if (! $task->is_complete)
                  {!! Form::model($tasks, ['route' => ['task.update', $task->id], 'method' => 'PUT']) !!}
                      <button type="submit" class="btn btn-info btn-sm center rounded-0"><i class="fa fa-check "></i> Complete</button>
                  {!! Form::close() !!}
                  @else
                    <span class="text-muted">Completada!</span>
                  @endif
               </td>
              {{-- <td><button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target=".bd-{{$vsx->id}}"><i class="fa fa-eye"></i></button></td> --}}
            </tr>
            @endforeach
          </tbody>
        </table>
        {{$tasks->appends(Request::all())->links()}}        
      </div>
    </div>
  </div>      
</div>
@endsection

@section('scripts')

@endsection