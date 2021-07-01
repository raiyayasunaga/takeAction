@extends('layouts.main')

@section('title', '作成画面')

@section('content')
  <div class="container">
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
            <th width="50%">クエスト一覧</th>
            <th width="20%">期限</th>
            <th width="10%">GETポイント</th>
            <th width="20%">Deathポイント</th>
          </tr>
        </thead>
        <tbody>
          @foreach($posts as $post)
          <tr>
            <td>
              <form method="post" action="{{ action('ActionController@pointget', ['id' => $post->id]) }}" onSubmit="return check()">
                <button type="submit" class="btn btn-primary p-1" >{{ $post->title }}</button>
                @csrf
                  <input type="hidden" name="user_point" value="{{$post->user_point}}">
              </form>
              <form method="post" action="{{ action('ActionController@pointless', ['id' => $post->id]) }}" onSubmit="return giveup()">
                <button type="submit" class="btn btn-outline-danger p-0">諦める</button>
                @csrf 
                  <input type="hidden" name="death_point" value="{{ $post->death_point }}">
              </form>
            </td>
            
            <!-- コントローラー側でmthodで残り時間を計算するプログラムを実装する -->
            <td>残り：{{ $post->DaysLeft() }}日</td>
            <td>{{ $post->user_point }}point</td>
            <td>-{{ $post->death_point }}point</td>
            <td></td>
          </tr>
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
