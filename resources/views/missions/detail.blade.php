@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <ol class="breadcrumb breadcrumb-arrow">
          <li><a href="{{ route('missions.index') }}">ミッション一覧</a></li>
          <li class="active"><span>{{ $mission->name }}</span></li>
        </ol>
      </div>
      <div class="col col-md-4">
        <nav class="panel panel-default">
          <div class="panel-heading">
            ミッション詳細
          </div>
          <div class="panel-body">
            <div class="row" style="padding-bottom:10px">
              <div class="col-xs-5"><strong>ミッション名</strong></div>
              <div class="col-xs-7">{{ $mission->name }}</div>
            </div>
            <div class="row" style="padding-bottom:10px">
              <div class="col-xs-5"><strong>カテゴリ</strong></div>
              <div class="col-xs-7">{{ $mission->category->name }}</div>
            </div>
            <div class="row" style="padding-bottom:10px">
              <div class="col-xs-5"><strong>単位</strong></div>
              <div class="col-xs-7">{{ $mission->score_unit }}</div>
            </div>
            <div class="row">
              <div class="col-xs-5"><strong>メモ</strong></div>
              <div class="col-xs-7">{{ $mission->memo }}</div>
            </div>
          </div>
        </nav>
      </div>
      <div class="column col-md-8">
        @if ( !$steps->isEmpty() )
          <div class="panel panel-default">
            <div class="panel-heading">
              チャート
            </div>
            <div class="panel-body">
              <canvas id="chart" width="400" height="200"></canvas>
            </div>
          </div>
        @endif
        <div class="panel panel-default">
          <div class="panel-heading">
            記録一覧
          </div>
          <table class="table">
            <thead>
              <tr>
                <th class="wp40">実施日</th>
                <th class="wp20">スコア</th>
                <th class="wp40">メモ</th>
              </tr>
            </thead>
            <tbody>
            @if ( !$steps->isEmpty() )
              @foreach($steps as $step)
                <tr>
                  <td>{{ $step->date }}</td>
                  <td>{{ $step->score . $mission->score_unit }}</td>
                  <td>{{ $step->memo }}</td>
                </tr>
              @endforeach
            @else
              <tr>
                <td colspan="3">記録は存在しません。</td>
              </tr>
            @endif
            </tbody>
          </table>
        </div>
      </div>    
    </div>
  </div>
@endsection

@section('scripts')
  @if ( !$steps->isEmpty() )
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
                steppedLine: true,
            }]
        },
        options: {
          scales: {
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