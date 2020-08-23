@extends('layout')

@section('styles')
  <link href="/fullcalendar-5.1.0/lib/main.css" rel="stylesheet" />
  <style>
    dl{
      display:flex;
      margin-bottom: 0px !important;
    }
    dt{
      width: 5%;
    }
    dd{
      width: auto;
    }
    .fc-event-title {
      display: none !important;
    }
  </style>
@endsection

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
            Missions
            <a href="{{ route('missions.create') }}" class="pull-right"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
          </div>
          <div class="list-group">
            @if ( !$missions->isEmpty() )
              @foreach($missions as $mission)
                <a href="{{ route('missions.detail', ['mission' => $mission]) }}" class="list-group-item" >
                  <dl>
                    <dt><span style="color:{{ $mission->color }};">●</span></dt>
                    <dd>
                      <h4 class="list-group-item-heading">
                        <span class="mission-name">{{ $mission->name }}</span>
                        <span class="category-label {{ $mission->category->color }} mb5">{{ $mission->category->name }}</span>
                      </h4>
                      <p class="list-group-item-text">
                        {{ $mission->latest_step_string() }}
                      </p>
                    </dd>
                  </dl>
                </a>
              @endforeach
            @else
              <span class="list-group-item">
                <h4 class="list-group-item-heading">ミッションが存在しません。</h4>
                「＋」ボタンからミッションを作成しましょう！
              </span>
            @endif
          </div>
        </nav>
        {{--  カレンダー  --}}
        <div class="panel panel-default">
          <div class="panel-heading">Calendar</div>
          <div class="panel-body">
            <div id="calendar"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script src="/fullcalendar-5.1.0/lib/main.js"></script>
  <script src="/fullcalendar-5.1.0/lib/locales/ja.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        locale: 'ja',
        dayMaxEvents: false,
        height: 'auto',
        displayEventTime: false,
        events: [
          @foreach($missions as $mission)
            @foreach($mission->steps as $step)
              {
                title: '{{ $step->score . $mission->score_unit }}',
                start: '{{ $step->date }}T00:00:00',
                color: '{{ $mission->color }}'
              },
            @endforeach
          @endforeach
        ],
      });
      calendar.render();
    });
  </script>
@endsection