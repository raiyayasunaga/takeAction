@extends('layouts.main')

@section('title', '証拠確認')

@section('content')
  <div class="container">
    <h3>クエスト完了確認</h3>
    <form action="{{ action('ActionController@verifycreate') }}" onSubmit="return check" method="post" enctype="multipart/form-data">
    クエスト内容
      <div style="background: white;">
        <h3 >{{ $verify_form->title }}</h3>
      </div>
      <h3 >{{ $verify_form->user_point }}</h3>

      <div class="row">
          <div class="col">
          <input type="file" name="image" id="image_profile" onchange="previewImage(this);">
        <img  src="/img" id="Nowimg" style="height: 200px; border: 1px solid black;">
          </div>
      </div>
      @csrf 
      <!-- 投稿毎に -->
      <input type="hidden" name="id" value="{{ $verify_form->id }}">
      <input type="hidden" name="photo_id" value="{{ Auth::user()->id }}">
      <input type="hidden" name="photo_title" value="{{ $verify_form->title }}">
      
      <!-- 獲得ポイントの所 -->
      <input type="hidden" name="user_point" value="{{ $verify_form->user_point }}">
      <input type="hidden" name="alert_level" value="{{ Auth::user()->alert_level }}">
      <input class="btn btn-primary" type="submit" value="確認する">
    </form>
  </div>
@endsection

@section('js')
  <script>
  function check(){
  if(window.confirm('証拠画像は登録できましたか？')){ // 確認ダイアログを表示
      return true; // 「OK」時は送信を実行
  }
  else{ // 「キャンセル」時の処理
      return false; // 送信を中止
  }
}
  function previewImage(obj)
  {
    let fileReader = new FileReader();
    fileReader.onload = (function() {
      document.getElementById('Nowimg').src = fileReader.result;
    });
    fileReader.readAsDataURL(obj.files[0]);
  }
  </script>
@endsection

