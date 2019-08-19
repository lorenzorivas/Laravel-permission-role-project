@extends('layouts.app')

@section('content')
    <div class="container">    
    <h2>Actividad usuarios</h2>
      {{ Form::open(['route' => 'activity.index', 'method' => 'GET']) }}
        <div class="input-group">
        <input type="text" class="form-control" placeholder="ingresa una búsqueda" name="busqueda">
          <div class="input-group-append">
            <button type="submit" class="btn btn-secondary"><i class="fa fa-search"></i></button>
          </div>
        </div>
      {{ Form::close() }}
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <br>
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
</div>
@endsection