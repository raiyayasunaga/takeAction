<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
         {{-- 後の章で説明します --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- 各ページごとにtitleタグを入れるために@yieldで空けておきます。 --}}
        <title>@yield('title')</title>

        <!-- Scripts -->
         {{-- Laravel標準で用意されているJavascriptを読み込みます --}}
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
        <!-- フラッシュメッセージを追加する時に必要なscript -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

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
    </head>
    <body>
        
        <div id="app">
          <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
              <div class="container">
                  <a class="navbar-brand" href="{{ url('admin') }}">
                      <img src="{{ asset('storage/img/' . Auth::user()->image_profile) }}" height="50px;">
                  </a>
                    <ul class="navbar-nav ml-auto">
                            <nav class="navMenu">
                                <ul>
                                    <li><a href="mypage">マイページ</a></li>
                                    <li><a href="create">ムチを作成</a></li>
                                    <li><a href="reward">ご褒美一覧</a></li>
                                    <li><a href="{{ route('admin.reward_create') }}">ご褒美作成</a></li>
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

                      <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <li><a href="{{ route('admin.mypage') }}" >マイページ</a></li>
                            <li><a href="{{ route('admin.create') }}">ムチを作成</a></li>
                            <li><a href="{{ route('admin.reward') }}">ご褒美一覧</a></li>
                            <li><a href="{{ route('admin.reward_create') }}">ご褒美作成</a></li>
                            <li><a href="{{ route('admin.users') }}">利用しているユーザー</a></li>
                        </ul>
                          @endguest
                  </div>
              </div>
          </nav>
            <main class="py-4">
                {{-- コンテンツをここに入れるため、@yieldで空けておきます。 --}}
                @yield('content')
            </main>
        </div>

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