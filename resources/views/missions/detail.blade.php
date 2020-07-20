@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <ol class="breadcrumb breadcrumb-arrow">
          <li><a href="{{ route('missions.index') }}"><i class="glyphicon glyphicon-home"></i></a></li>
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
            {{--  ミッション詳細  --}}
            {{ $mission->name }}<span class="category-label {{ $mission->category->color }}">{{ $mission->category->name }}</span>
            <a href="{{ route('missions.edit', ['mission'=>$mission]) }}" class="pull-right"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
          </div>
          <div class="panel-body">
            {{ $mission->memo ? $mission->memo : 'メモなし' }}
          </div>
        </div>
        <div class="panel panel-default pc">
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
              <canvas id="chart" class="canvas"></canvas>
            </div>
          </div>
        @endif
        <div class="panel panel-default">
          <div class="panel-heading">履歴</div>
          <table class="table">
            <thead>
              <tr>
                <th class="wp30 tac-sp">実施日</th>
                <th class="wp30 tac-sp">スコア</th>
                <th class="wp40 tac-sp">メモ</th>
              </tr>
            </thead>
            <tbody>
            @if ( !$steps->isEmpty() )
              @foreach($steps as $step)
                <tr>
                  <td class="tac-sp"><a href="{{ route('steps.edit', ['mission' => $mission, 'step' => $step]) }}">{{ $step->formatted_date }}</a></td>
                  <td class="tac-sp">{{ $step->score . $mission->score_unit }}</td>
                  <td>{{ $step->memo ? $step->memo : '---' }}</td>
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

@section('sp-menu')
  {{--  スマホ用固定フッター  --}}
  <div id="add-btn" class="add-btn">
    <a href="#" data-toggle="modal" data-target="#add_step_modal">＋</a>
    {{--  <button type="button" data-toggle="modal" data-target="#add_step_modal">
      ＋
    </button>  --}}
  </div>
@endsection

@section('scripts')
  <script>
    $(function() {
      var topBtn = $('#add-btn');
      //フッター手前でボタンを止める（ここを追加する）
      $(window).scroll(function () {
          var height = $(document).height(); //ドキュメントの高さ 
          var position = $(window).height() + $(window).scrollTop(); //ページトップから現在地までの高さ
          var footer = $("footer").height(); //フッターの高さ
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
      //スクロールしてトップへ戻る
      {{--  topBtn.click(function () {
          $('body,html').animate({
              scrollTop: 0
          }, 500);
          return false;
      });  --}}
  });



    var today = new Date();
    today.setDate(today.getDate());
    var yyyy = today.getFullYear();
    var mm = ("0"+(today.getMonth()+1)).slice(-2);
    var dd = ("0"+today.getDate()).slice(-2);
    document.getElementById("date").value=yyyy+'-'+mm+'-'+dd;
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