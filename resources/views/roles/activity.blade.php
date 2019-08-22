@extends('layouts.dash')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Actividad</h1>
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

{{ Form::open(['route' => 'activity.index', 'method' => 'GET']) }}
  <div class="input-group">
  <input type="text" class="form-control" placeholder="ingresa una búsqueda" name="busqueda">
    <div class="input-group-append">
      <button type="submit" class="btn btn-secondary"><i class="fa fa-search"></i></button>
    </div>
  </div>
{{ Form::close() }}
<br>
<div class="table-responsive">
  <table class="table table-striped">
    <tbody>
    @foreach($activities as $activity)
    <tr>
      <td>{{ $activity->log_name }} <br> 
        <span class="badge badge-info">{{ $activity->description }}</span>
      </td>
      <td>
        @if(!$activity->causer['name'])
        system {{ $activity->description }} in {{ $activity->subject_type }} <br>el: {{ $activity->created_at }}
        @else
        {{ $activity->causer['name'] }} {{ $activity->description }} in {{ $activity->subject_type }} <br>el: {{ $activity->created_at }}
        @endif
      </td>
      <td>
        @if(str_contains($activity->properties, '"old"') !== false )
        @foreach($activity->changes['attributes'] as $field => $value)
            {{-- {{ $loop->first ? '' : ', ' }} --}}
            <strong>{{ $field }}</strong>: 
            {{ $activity->changes['old'][$field] }}
            to
            {{ $activity->changes['attributes'][$field] }}
            <br>
        @endforeach
        @else
        @foreach($activity->changes['attributes'] as $field => $value)
            {{-- {{ $loop->first ? '' : ', ' }} --}}
            <strong>{{ $field }}</strong>:
            {{ $activity->changes['attributes'][$field] }}
            <br>
        @endforeach
        @endif
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
{{$activities->appends(Request::all())->links()}}
</div>

@endsection