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
              <div class="col-xs-4"><strong>ミッション名</strong></div>
              <div class="col-xs-8">{{ $mission->name }}</div>
            </div>
            <div class="row" style="padding-bottom:10px">
              <div class="col-xs-4"><strong>カテゴリ</strong></div>
              <div class="col-xs-8">{{ $mission->category->name }}</div>
            </div>
            <div class="row" style="padding-bottom:10px">
              <div class="col-xs-4"><strong>単位</strong></div>
              <div class="col-xs-8">{{ $mission->level_unit }}</div>
            </div>
            <div class="row">
              <div class="col-xs-4"><strong>メモ</strong></div>
              <div class="col-xs-8">{{ $mission->memo }}</div>
            </div>
          </div>
        </nav>
      </div>
      <div class="column col-md-8">
        <div class="panel panel-default">
        </div>
        <div class="panel panel-default">
        </div>
      </div>    
    </div>
  </div>
@endsection
