@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-offset-3 col-md-6">
        <ol class="breadcrumb breadcrumb-arrow">
          <li><a href="{{ route('missions.index') }}">ミッション一覧</a></li>
          <li><a href="{{ route('missions.detail', ['mission' => $mission]) }}">{{ $mission->name }}</a></li>
          <li class="active"><span>ステップ編集</span></li>
        </ol>
      </div>
      <div class="col col-md-offset-3 col-md-6">
        <nav class="panel panel-default">
          <div class="panel-heading">『{{ $step->date }}』を編集する</div>
          <div class="panel-body">
            @if($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach($errors->all() as $message)
                    <li>{{ $message }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
            <form action="{{ route('steps.edit', ['mission' => $mission, 'step' => $step]) }}" method="post">
              @csrf
              <div class="form-group">
                <label for="score">スコア ({{ $mission->score_unit }})</label>
                <input type="number" class="form-control" name="score" id="score" value="{{ old('score') ?? $step->score }}" />
              </div>
              <div class="form-group">
                <label for="memo">メモ</label>
                <textarea class="form-control" name="memo" id="memo" rows="3">{{ old('memo') ?? $step->memo }}</textarea>
              </div>
              <div class="text-right">
                <button type="submit" class="btn btn-primary">更新する</button>
              </div>
            </form>
          </div>
        </nav>
        <div class="text-center">
          <a href="{{ url()->previous() }}">戻る</a>
        </div>
      </div>
    </div>
  </div>
@endsection