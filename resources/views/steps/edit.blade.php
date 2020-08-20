@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-md-offset-3 col-md-6">
        <nav class="panel panel-default">
          <div class="panel-heading">編集</div>
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
            <div class="form-group">
              <label for="score">スコア<span class="label red ml10">必須</span></label>
              <div class="input-group">
                <input type="number" class="form-control" name="score" id="score" value="{{ old('score') ?? $step->score }}" form="step_update" step="0.1" pattern="\d+(\.\d*)?" />
                <span class="input-group-addon">{{ $mission->score_unit }}</span>
              </div>
            </div>
            <div class="form-group">
              <label for="memo">メモ</label>
              <textarea class="form-control" name="memo" id="memo" rows="3" form="step_update">{{ old('memo') ?? $step->memo }}</textarea>
            </div>
            <div class="text-right">
              <form id="delete_step_{{ $step->id }}" method="POST" action="{{ route('steps.delete', ['mission' => $mission, 'step' => $step]) }}" style="display:inline;">
                @csrf
                <a href="javascript:void(0)" onclick="delete_confirm( 'delete_step_{{ $step->id }}', 'ステップを削除します。よろしいですか。' )" style="color:red;">削除する</a>
              </form>
              <form id="step_update" action="{{ route('steps.edit', ['mission' => $mission, 'step' => $step]) }}" method="post" style="display:inline; margin-left:10px; margin-right:10px;">
                @csrf
                <button type="submit" class="btn btn-primary">更新する</button>
              </form>
            </div>
          </div>
        </nav>
        <div class="text-center">
          <a href="{{ route('missions.detail', ['mission' => $mission]) }}">戻る</a>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script type="text/javascript">
    function delete_confirm( step_id, message ){
      if(window.confirm(message)){
        var target = document.getElementById( step_id );
        target.method = "post";
        target.submit();
      }
    }
  </script>
@endsection