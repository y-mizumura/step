@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-offset-3 col-md-6">
        <ol class="breadcrumb breadcrumb-arrow">
          <li><a href="{{ route('missions.index') }}"><i class="glyphicon glyphicon-home"></i></a></li>
          <li class="active"><span>ミッション追加</span></li>
        </ol>
      </div>
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
                <label for="name">ミッション名<span class="label red ml10">必須</span></label>
                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" />
              </div>
              <div class="form-group">
                <label for="category_id">カテゴリ<span class="label red ml10">必須</span></label>
                <select class="form-control" id="category_id" name="category_id">
                  @foreach($categories as $category)
                     <option value="{{ $category->id }}" {{ old('category')===$category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                  @endforeach
               </select>
              </div>
              <div class="form-group">
                <label for="color">色<span class="label red ml10">必須</span></label>
                <input type="color" class="form-control" name="color" id="color">
              </div>
              <div class="form-group">
                <label for="score_unit">単位<span class="label red ml10">必須</span></label>
                <input type="text" class="form-control" name="score_unit" id="score_unit" value="{{ old('score_unit') }}" />
              </div>
              <div class="form-group">
                <label for="memo">メモ</label>
                <textarea class="form-control" name="memo" id="memo" value="{{ old('memo') }}" rows="3"></textarea>
              </div>
              <div class="text-right">
                <button type="submit" class="btn btn-primary">追加する</button>
              </div>
            </form>
          </div>
        </nav>
      </div>
    </div>
  </div>
@endsection