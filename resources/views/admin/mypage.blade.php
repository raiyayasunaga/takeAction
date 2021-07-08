@extends('layouts.main')

@section('title', 'mypage画面')

@section('content')
    @foreach($notices as $notice)
      <div class="modal js-modal">
          <div class="modal__bg js-modal-close"></div>
          <div class="modal__content">
              <p>{{ $notice->who }}さんの目標({{ $notice->popose}})が{{ $notice->action }}されました！</p>
              <!-- 非同期通信 -->
              <!-- カラムに人数分のレコードユーザー分できる３人分をデータ渡すto関連ずけintegerカラムA、テーブル場合は通知したかどうか -->
              <a class="js-modal-close" href="">閉じる</a>
          </div><!--modal__inner-->
      </div>
    @endforeach
  <div class="container">
    <h3 class="mb-5"><a href="mypageedit">マイページの設定</a></h3>
    <h3><a class="btn btn-danger" href="{{ route('verified.photo') }}">今までの記録一覧</a></h3>
    <button class="demo btn btn-primary">ローカルストレージ消去</button>
    <a class="btn btn-primary" href="actionplanning">まだ実行していない課題一覧</a>
    <div class="row mt-5">
    <h3>購入履歴</h3>
      <table class="table">
        <thead>
          <tr>
            <th width="80%">タイトル</th>
            <th width="20%">有効期限</th>
          </tr>
        </thead>
        <tbody>
          @foreach($rewards as $reward)
            <tr>
              <td>{{ $reward->record_title }}</td>
              <!-- createad_atの正規表現 -->
              <td>あと{{ $reward->getRemaindingDays() }}時間</td>
              <!-- <td>{{ preg_replace("/[0-9]{4}|([01][0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]/", "", $reward->created_at) }}</td> -->
            </tr>
          @endforeach
        </tbody>
      </table>
      </div>
    </div>
  </div>
@endsection

@section('js')
<script>
  window.onload = function()
  {
    $(function(){
      // これで一度だけ表示できるようになった
      if(!localStorage.getItem("btn-click")){
      localStorage.setItem("btn-click", "check");
      $('.js-modal').fadeIn();
            $('.js-modal-close').one('click',function(){ 
                $('.js-modal').fadeOut();
                return false;
            });
      }
    });
    $(function() {
      $(".demo").on("click", function() {
        localStorage.clear("btn-click");
      });
    });

  }

  

</script>
@endsection




