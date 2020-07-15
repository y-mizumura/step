@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-md-offset-3 col-md-6">
        <nav class="panel panel-default">
          <div class="panel-heading">
            ミッション一覧
            <a href="{{ route('missions.create') }}" class="pull-right"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>追加</a>
          </div>
          <div class="list-group">
            @foreach($missions as $mission)
              <a href="{{ route('steps.index', ['mission' => $mission]) }}" class="list-group-item" >
                {{ $mission->name }}
              </a>
            @endforeach
          </div>
        </nav>
      </div>
    </div>
  </div>
@endsection
