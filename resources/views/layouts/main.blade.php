<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

        <!-- jquery UI -->
        
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

        <!-- 通知件数表示vueライブラリー -->
        <script src="https://cdn.jsdelivr.net/npm/vue-notification-bell@0.8.14/dist/NotificationBell.umd.min.js"></script>

        <!-- フラッシュメッセージを追加する時に必要なscript -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <!-- 日本語表記 -->
        
         
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
        <!-- プッシュ機能 -->
        <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
        <script>
        window.OneSignal = window.OneSignal || [];
        OneSignal.push(function() {
            OneSignal.init({
            appId: "43e804fb-c314-4419-be43-36b84e63ec73",
            });
        });
    </script>
        @yield('style')
    </head>
    <body>
        
        <div id="app">
          <nav class="navbar navbar-expand-md navbar-light shadow-sm bg-white" style="background: -webkit-linear-gradient(to right, #8e0e00, #1f1c18);">
              <div class="container">
                  <div><a href="{{ url('admin') }}"><img src="{{ Auth::user()->image_profile }}" height="40" alt=""></a></div>
                   <!-- Left Side Of Navbar -->
                   <ul class="navbar-nav mr-auto">
                            <li class="nav-item dropdown">
                                  <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                      {{ Auth::user()->name }} <span class="caret"></span>
                                  </a>

                                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                      <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                          {{ __('Logout') }}
                                      </a>

                                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                          @csrf
                                      </form>
                                  </div>
                              </li>
                      </ul>
                    <ul class="navbar-nav ml-auto">
                            <nav class="navMenu">
                                <ul>
                                    <li><a class="btn btn-primary mr-3" href="{{ url('admin') }}">ホームページ</a></li>
                                    <li><a class="nav-font" href="{{ route('admin.mypage') }}" >マイページ</a></li>
                                    <li><a class="nav-font" href="{{ route('admin.create') }}">ムチを作成</a></li>
                                    <li><a class="nav-font" href="{{ route('admin.reward') }}">ご褒美一覧</a></li>
                                    <li><a class="nav-font" href="{{ route('admin.reward_create') }}">ご褒美作成</a></li>
                                    <li><a class="nav-font" href="{{ route('admin.users') }}">利用しているユーザー</a></li>
                                    <li><a class="nav-font" href="{{ route('home') }}">チャット可能ユーザー</a></li>
                                </ul>
                            </nav>

                            <!-- メニュー -->
                            <div class="hamburgar">
                                <span class="toggle-span"></span>
                                <span></span>
                                <span></span>
                            </div>
                    </ul>
                  @guest

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                    @else

                  <div class="collapse navbar-collapse" id="navbarSupportedContent">

                      <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <li><a class="btn btn-primary mr-3" href="{{ url('admin') }}">ホームページ</a></li>
                            <li><a class="btn btn-success" href="{{ route('admin.mypage') }}" >マイページ</a></li>
                            <li><a class="btn btn-success" href="{{ route('admin.create') }}">課題を作成</a></li>
                            <li><a class="btn btn-success" href="{{ route('admin.reward') }}">ご褒美一覧</a></li>
                            <li><a class="btn btn-success" href="{{ route('admin.reward_create') }}">ご褒美作成</a></li>
                            <li><a class="btn btn-success" href="{{ route('admin.users') }}">利用しているユーザー</a></li>
                            <li><a class="btn btn-success" href="{{ route('home') }}">チャット可能なユーザー</a></li>
                        </ul>
                          @endguest
                  </div>
              </div>
          </nav>
            <main >
                @yield('content')
            </main>
        </div>
        <script src="https://js.pusher.com/3.2/pusher.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/push.js/0.0.11/push.min.js"></script>
        @yield('js')
        <script>
            @if (session('msg_success'))
                $(function () {
                    toastr.success('{{ session('msg_success') }}');
                });
            @endif

            // {{--失敗時--}}
            @if (session('msg_danger'))
                $(function () {
                    toastr.danger('{{ session('msg_danger') }}');
                });
            @endif
        </script>
    </body>
</html>