@extends('layouts.main')

@section('title', 'mypage画面')

@section('content')
  <div class="container">
    <div class="row my-3">
      <h4>マイ画像の設定</h4>
        <div class="col">
          <img src="/img/" id="img" width="100px">
        </div>
    </div>
    <div class="row my-3"> 
      <h4>名前の変更</h4>
      <div class="col">
        <input type="text" class="form-control" value="{{ Auth::user()->name }}">
      </div>
    </div>
    <div class="row my-3">
      <h4>通知設定</h4>
      <button>オン</button>
    </div>
    @csrf
    <input type="submit" value="追加する">
  </div>
@endsection

