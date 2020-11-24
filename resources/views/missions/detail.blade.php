@extends('layout')

@section('styles')
  <link href="/fullcalendar-5.1.0/lib/main.css" rel="stylesheet" />
  <style>
    dl{
      display:flex;
      margin-bottom: 0px !important;
    }
    dt{
      width: 95%;
    }
    dd{
      width: 5%;
    }
    @media only screen and (max-device-width: 480px) {
      .fc-event-time, .fc-event-title {
        padding: 0 1px;
        float: left;
        clear: none;
        margin-right: 10px;
      }
    }
  </style>
@endsection

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        @if($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach($errors->all() as $message)
                <li>{{ $message }}</li>
              @endforeach
            </ul>
          </div>
        @endif
        @if (Session::has('message'))
          <div class="alert alert-success">
              {{ session('message') }}
          </div>
        @endif
      </div>
      <div class="col col-md-4">
        <div class="panel panel-default">
          <div class="panel-heading">
            {{--  ミッション詳細  --}}
            <dl>
              <dt>
                <span class="mission-name">{{ $mission->name }}</span>
                <span class="category-label {{ $mission->category->color }}">{{ $mission->category->name }}</span>
              </dt>
              <dd>
                <a href="{{ route('missions.edit', ['mission'=>$mission]) }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
              </dd>
            </dl>
          </div>
          <div class="panel-body">
            {!! $mission->memo ?  nl2br(e($mission->memo)) : 'メモなし' !!}
          </div>
        </div>
        @if ( !$steps->isEmpty() )
          <div class="panel panel-default pc">
            <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#add_step_modal">
              ステップを追加
            </button>
          </div>
        @endif
      </div>
      <div class="column col-md-8">
        @if ( !$steps->isEmpty() )
          <div class="panel panel-default">
            <div class="panel-heading">チャート（過去10件）</div>
            <div class="panel-body">
              <canvas id="chart" class="canvas"></canvas>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">履歴（過去3ヶ月）</div>
            <ul id="myTab1" class="nav nav-tabs">
              <li class="active"><a href="#calendar-tab" data-toggle="tab">Calendar</a></li>
              <li><a href="#list-tab" data-toggle="tab">List</a></li>
            </ul>
            <div id="myTabContent" class="tab-content">
              <div class="tab-pane fade active in" id="calendar-tab">
                <div id="calendar"></div>
              </div>
              <div class="tab-pane fade" id="list-tab">
                <table class="table">
                  <thead>
                    <tr>
                      <th class="th1 tac">実施日</th>
                      <th class="th2 tac">スコア</th>
                      <th class="th3 tac">メモ</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($steps as $step)
                      <tr>
                        <td class="td1 tac"><a href="{{ route('steps.edit', ['mission' => $mission, 'step' => $step]) }}">{{ $step->formatted_date }}</a></td>
                        <td class="td2 tac">{{ $step->score . $mission->score_unit }}</td>
                        <td class="td3">{!! $step->memo ? nl2br(e($step->memo)) : '---' !!}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        @else
          <div class="panel panel-default">
            <div class="panel-heading">ステップを追加しましょう！</div>
            <div class="panel-body">
              <p>まだ、記録がありません。<br/>こちらより、ステップを追加しましょう！</p>
              <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#add_step_modal">
                ステップを追加
              </button>
            </div>    
          </div>
        @endif
      </div>
    </div>
  </div>
  {{--  モーダル  --}}
  <div class="modal fade" id="add_step_modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-center">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">ステップを追加</h4>
        </div>
        <div class="modal-body">
          <form id="add_step_form" action="{{ route('steps.create', ['mission' => $mission]) }}" method="post">
            @csrf
            <div class="form-group">
              <label for="date">実施日<span class="label red ml10">必須</span></label>
              <input type="date" class="form-control" name="date" id="date" value="{{ old('date') }}" />
            </div>
            <div class="form-group">
              <label for="score">スコア<span class="label red ml10">必須</span></label>
              <div class="input-group">
                <input type="number" class="form-control" name="score" id="score" value="{{ old('score') }}" step="0.1" pattern="\d+(\.\d*)?"/>
                <span class="input-group-addon">{{ $mission->score_unit }}</span>
              </div>
            </div>
            <div class="form-group">
              <label for="memo">メモ</label>
              <textarea class="form-control" name="memo" id="memo" rows="3">{{ old('memo') }}</textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
          <button type="submit" form="add_step_form" class="btn btn-primary">追加する</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@if ( !$steps->isEmpty() )
  @section('sp-menu')
    {{--  スマホ用固定フッター  --}}
    <div id="add-btn" class="add-btn sp">
      <a href="#" data-toggle="modal" data-target="#add_step_modal">＋</a>
    </div>
  @endsection
@endif

@section('scripts')
  <script>
    $(function() {
      // スマホ：ページ下部に固定したボタンがfooterに被らないようにする処理
      // → iOSの場合、この方法ではツールバー非表示時に被る。
      // → CSSの方法に要調整
      var topBtn = $('#add-btn');
      $(window).scroll(function () {
          var height = $(document).height();
          var position = window.innerHeight + $(window).scrollTop();
          var footer = $("footer").height();
          if ( height - position  < footer ) { 
              topBtn.css({
                position : "absolute",
                top : -50
              });
          } else { 
              topBtn.css({
                position : "fixed",
                top: "auto"
              });
          }
      });
    });

    var today = new Date();
    today.setDate(today.getDate());
    var yyyy = today.getFullYear();
    var mm = ("0"+(today.getMonth()+1)).slice(-2);
    var dd = ("0"+today.getDate()).slice(-2);
    document.getElementById("date").value=yyyy+'-'+mm+'-'+dd;
  </script>

  @if ( !$steps->isEmpty() )
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
            @foreach($steps as $step)
              {
                title: '{{ $step->score . $mission->score_unit }}',
                start: '{{ $step->date }}T00:00:00',
                color: '{{ $mission->color }}',
                url: '{{ route('steps.edit', ['mission' => $mission, 'step' => $step]) }}'
              },
            @endforeach
          ],
          eventClick: function(info) {
            info.jsEvent.preventDefault(); // don't let the browser navigate
            if (info.event.url) {
              location.href = info.event.url;
            }
          }
        });
        calendar.render();
      });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js"></script>
    <script>
      var ctx = document.getElementById('chart').getContext('2d');
      var chart = new Chart(ctx, {
        type: 'line',
        data: {
            datasets: [{
                label: 'スコア ({{$mission->score_unit}})',
                data: [
                  @foreach($steps_for_chart as $step)
                    {
                      x: '{{ $step->date }}',
                      y: {{ $step->score }}
                    },
                  @endforeach
                ],
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255,99,132,1)',
                borderWidth: 1,
                steppedLine: 'after',
            }]
        },
        options: {
          maintainAspectRatio: false,
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true
              }
            }],
            xAxes: [{
              type: 'time',
              time: {
                unit: 'day',
                displayFormats: {
                  day: 'M/D'
                }
              },
              distribution: 'series'
            }]
          }
        }
      });
    </script>
  @endif
@endsection