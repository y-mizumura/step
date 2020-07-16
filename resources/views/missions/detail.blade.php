@extends('layout')

@section('styles')
  @include('share.flatpickr.styles')
@endsection

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <ol class="breadcrumb breadcrumb-arrow">
          <li><a href="{{ route('missions.index') }}">ミッション一覧</a></li>
          <li class="active"><span>{{ $mission->name }}</span></li>
        </ol>
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
            ミッション詳細
            <a href="{{ route('missions.edit', ['mission'=>$mission]) }}" class="pull-right"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>編集</a>
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
            <div class="row">
              <div class="col-xs-5"><strong>メモ</strong></div>
              <div class="col-xs-7">{{ $mission->memo }}</div>
            </div>
          </div>
        </div>
        <div class="panel panel-default">
          <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#add_step_modal">
            ステップを追加
          </button>
        </div>
      </div>
      <div class="column col-md-8">
        @if ( !$steps->isEmpty() )
          <div class="panel panel-default">
            <div class="panel-heading">チャート</div>
            <div class="panel-body">
              <canvas id="chart" width="400" height="200"></canvas>
            </div>
          </div>
        @endif
        <div class="panel panel-default">
          <div class="panel-heading">ステップ履歴</div>
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
                  <td><a href="{{ route('steps.edit', ['mission' => $mission, 'step' => $step]) }}">{{ $step->date }}</a></td>
                  <td>{{ $step->score . $mission->score_unit }}</td>
                  <td>{{ $step->memo }}</td>
                </tr>
              @endforeach
            @else
              <tr>
                <td colspan="3">ステップは存在しません。</td>
              </tr>
            @endif
            </tbody>
          </table>
        </div>
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
              <input type="text" class="form-control" name="date" id="date" value="{{ old('date') }}" />
            </div>
            <div class="form-group">
              <label for="score">スコア<span class="label red ml10">必須</span></label>
              <div class="input-group">
                <input type="number" class="form-control" name="score" id="score" value="{{ old('score') }}" />
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

@section('scripts')
  @include('share.flatpickr.scripts')
  <script>
    flatpickr(document.getElementById('date'), {
      locale: 'ja',
      dateFormat: "Y/m/d",
      minDate: new Date(),
      weekNumbers: true
    });
  </script>

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
                steppedLine: 'after',
            }]
        },
        options: {
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