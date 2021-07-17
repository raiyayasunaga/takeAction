@extends('layouts.main')

@section('title', '作成画面')

@section('style')
  @if (Auth::user()->alert_level == 1)
    <link href="{{ asset('css/level_1.css') }}" rel="stylesheet">
  @elseif (Auth::user()->alert_level == 2)
    <link href="{{ asset('css/level_2.css') }}" rel="stylesheet">
  @elseif (Auth::user()->alert_level == 3)
    <link href="{{ asset('css/level_3.css') }}" rel="stylesheet">
  @endif
@endsection

@section('content')
{{ Breadcrumbs::render('admin') }}
  <div class="container mt-5">
    <div class="row">
      <div class="col">
        <h3>最近の課題</h3>
        <h4>現在の獲得ポイント:{{ Auth::user()->point }}</h4>
      </div>
    </div>
    <div class="row">
      <table class="table">
        <thead>
          <tr>
            <th width="40%">クエスト一覧</th>
            <th width="20%">期限</th>
            <th width="20%">ポイント</th>
            <th width="20%">-ポイント</th>
          </tr>
        </thead>
        <tbody>
          @foreach(Auth::user()->posts as $post)
            @if($post->public == 1)
              <tr>
                <td>
                  <a class="btn btn-primary p-1" href="{{ route('verify.form', ['id' => $post->id]) }}">{{ $post->title }}
                  </a>
                  <form method="post" action="{{ action('ActionController@pointless', ['id' => $post->id]) }}" onSubmit="return giveup()">
                    <button type="submit" class="btn btn-outline-danger p-0">諦める</button>
                    @csrf 
                      <input type="hidden" name="death_point" value="{{ $post->death_point }}">
                      <input type="hidden" name="alert_level" value="{{ Auth::user()->alert_level }}">
                  </form>
                </td>
                
                <!-- コントローラー側でmthodで残り時間を計算するプログラムを実装する -->
                @if($post->getstart() == 0)
                <td>{{ $post->getendDays() }}{{ $post->getendHours() }}</td>
                  @elseif($post->getstart() > 0)
                <td>始まるまで後{{ $post->getstart() }}時間</td>
                @endif
                <td>{{ $post->user_point }}point</td>
                <td>-{{ $post->death_point }}point</td>
              </tr>
            @endif
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection

@section('js')
<script>
function check(){
  if(window.confirm('本当に実行してもよろしいですか？')){ // 確認ダイアログを表示
      return true; // 「OK」時は送信を実行
  }
  else{ // 「キャンセル」時の処理
  // 警告ダイアログを表示
      return false; // 送信を中止
  }
}
function giveup() {
  if(window.confirm('本当に諦めて良いんですか！？')) {
    return true;
  }
  else {
    return false;
  }
}
</script>
@endsection
