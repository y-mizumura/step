@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-md-offset-3 col-md-6">
        @if (Session::has('message'))
          <div class="alert alert-success">
              {{ session('message') }}
          </div>
        @endif
        <nav class="panel panel-default">
          <div class="panel-heading">
            ミッション一覧
            <a href="{{ route('missions.create') }}" class="pull-right"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>追加</a>
          </div>
          <div class="list-group">
            @if ( !$missions->isEmpty() )
              @foreach($missions as $mission)
                <a href="{{ route('missions.detail', ['mission' => $mission]) }}" class="list-group-item" >
                  <h4 class="list-group-item-heading">{{ $mission->name }}<span class="label {{ $mission->category->color }} ml10 mb5">{{ $mission->category->name }}</span></h4>
                  <p class="list-group-item-text">最終実施日：{{ $mission->latest_step() ? $mission->latest_step()->date : '未実施' }}</p>
                </a>
              @endforeach
            @else
              <span class="list-group-item">ミッションは存在しません。</span>
            @endif
          </div>
        </nav>
      </div>
    </div>
  </div>
@endsection
