@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-md-offset-3 col-md-6">
        @if($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach($errors->all() as $message)
                <li>{{ $message }}</li>
              @endforeach
            </ul>
          </div>
        @endif
        @if (Session::has('status'))
          <div class="alert alert-success">
              {{ session('status') }}
          </div>
        @endif
        <nav class="panel panel-default">
          <div class="panel-heading">パスワード変更</div>
          <div class="panel-body">
            <form action="{{ route('password.change') }}" method="POST">
              @csrf
              <div class="form-group">
                <label for="current_password">現在のパスワード<span class="label red ml10">必須</span></label>
                <input id="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" autocomplete="new-password">
              </div>
              <div class="form-group">
                <label for="password">新しいパスワード<span class="label red ml10">必須</span></label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
              </div>
              <div class="form-group">
                <label for="password-confirm">新しいパスワード（確認）<span class="label red ml10">必須</span></label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
              </div>
              <div class="text-right">
                <button type="submit" class="btn btn-primary">送信</button>
              </div>
            </form>
          </div>
        </nav>
      </div>
    </div>
  </div>
@endsection