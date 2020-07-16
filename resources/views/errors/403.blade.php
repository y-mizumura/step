@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-md-offset-3 col-md-6">
        <div class="text-center">
          <h3>403 Error</h3>
          <p>アクセス権限がありません。</p>
          <a href="{{ route('home') }}" class="btn btn-primary">ホームへ戻る</a>
        </div>
      </div>
    </div>
  </div>
@endsection