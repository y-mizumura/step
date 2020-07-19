<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
  <meta name="robots" content="noindex" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>記録管理アプリ</title>
  @yield('styles')
  <link rel="stylesheet" href="/css/styles.css?ver=1.0.4">
</head>
<body>
  <header>
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand my-navbar-brand" href="/">記録管理アプリ</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            @if(Auth::check())
              <li><a href="{{ route('password.form') }}">パスワード変更</a></li>
              <li>
                <a href="#" id="logout">ログアウト</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </li>
              @else
              <li><a href="{{ route('login') }}">ログイン</a></li>
                <li><a href="{{ route('register') }}">会員登録</a></li>
            @endif
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <main>
    @yield('content')
  </main>
  <footer>
    <div class="col-md-12">
      <div class="footer">
        <div class="container">
          <div class="footer-copyright text-center">Copyright © 2020 xxxx.</div>
        </div>
      </div>
    </div>
  </footer>
@if(Auth::check())
  <script>
    document.getElementById('logout').addEventListener('click', function(event) {
      event.preventDefault();
      document.getElementById('logout-form').submit();
    });
  </script>
@endif
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
@yield('scripts')
</body>
</html>