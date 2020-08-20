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
              <label for="name">ミッション名<span class="label red ml10">必須</span></label>
              <input type="text" class="form-control" name="name" id="name" value="{{ old('name') ?? $mission->name }}" form="mission_update"/>
            </div>
            <div class="form-group">
              <label for="category_id">カテゴリ<span class="label red ml10">必須</span></label>
              <select class="form-control" id="category_id" name="category_id" form="mission_update">
                @foreach($categories as $category)
                   <option value="{{ $category->id }}" {{ $category->id==old('category', $mission->category_id) ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
             </select>
            </div>
            <div class="form-group">
              <label for="color">色<span class="label red ml10">必須</span></label>
              <input type="color" class="form-control" name="color" id="color" value="{{ old('color') ?? $mission->color }}" form="mission_update">
            </div>
            <div class="form-group">
              <label for="score_unit">単位<span class="label red ml10">必須</span></label>
              <input type="text" class="form-control" name="score_unit" id="score_unit" value="{{ old('score_unit') ?? $mission->score_unit }}" form="mission_update" />
            </div>
            <div class="form-group">
              <label for="memo">メモ</label>
              <textarea class="form-control" name="memo" id="memo" rows="3" form="mission_update">{{ old('memo') ?? $mission->memo }}</textarea>
            </div>
            <div class="text-right">
              <form id="delete_mission_{{ $mission->id }}" method="POST" action="{{ route('missions.delete', ['mission' => $mission]) }}" style="display:inline;">
                @csrf
                <a href="javascript:void(0)" onclick="delete_confirm( 'delete_mission_{{ $mission->id }}', 'ミッションを削除します。\n関連するステップも削除されますが、よろしいですか。' )" style="color:red;">削除する</a>
              </form>
              <form id="mission_update" action="{{ route('missions.edit', ['mission' => $mission]) }}" method="post" style="display:inline; margin-left:10px; margin-right:10px;">
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
    function delete_confirm( mission_id, message ){
      if(window.confirm(message)){
        var target = document.getElementById( mission_id );
        target.method = "post";
        target.submit();
      }
    }
  </script>
@endsection