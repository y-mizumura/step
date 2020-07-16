@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-md-offset-3 col-md-6">
        <nav class="panel panel-default">
          <div class="panel-heading">ミッションを追加する</div>
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
            <form action="{{ route('missions.create') }}" method="post">
              @csrf
              <div class="form-group">
                <label for="title">ミッション名</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" />
              </div>
              <div class="form-group">
                <label for="title">カテゴリ</label>
                <select class="form-control" id="category_id" name="category_id">
                  @foreach($categories as $category)
                     <option value="{{ $category->id }}" {{ old('category')===$category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                  @endforeach
               </select>
              </div>
              <div class="form-group">
                <label for="title">単位</label>
                <input type="text" class="form-control" name="score_unit" id="score_unit" value="{{ old('score_unit') }}" />
              </div>
              <div class="form-group">
                <label for="title">メモ</label>
                <textarea class="form-control" name="memo" id="memo" value="{{ old('memo') }}" rows="3"></textarea>
              </div>
              <div class="text-right">
                <button type="submit" class="btn btn-primary">追加する</button>
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