@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
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
              <div class="col-xs-7">{{ $mission->level_unit }}</div>
            </div>
            <div class="row">
              <div class="col-xs-5"><strong>メモ</strong></div>
              <div class="col-xs-7">{{ $mission->memo }}</div>
            </div>
          </div>
        </nav>
      </div>
      <div class="column col-md-8">
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
                  <td>{{ $step->level . $mission->level_unit }}</td>
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
        <div class="panel panel-default">
        </div>
      </div>    
    </div>
  </div>
@endsection
