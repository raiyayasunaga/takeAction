@extends('layouts.main')

@section('title', '公開画面')

@section('content')
  <div class="container">
  <!-- autocomplete="off"で予測入力が消せる！！ -->
  <form action="{{ action('ActionController@runpublic') }}" onSubmit="return check" method="post" enctype="multipart/form-data" autocomplete="off">
    @if (count($errors) > 0)
      <ul>
          @foreach($errors->all() as $e)
              <li>{{ $e }}</li>
          @endforeach
      </ul>
    @endif
    <div class="row">
        <div class="col">
          <h2>課題公開する画面</h2>
            <input type="text" name="title" class="form-control" placeholder="例：1日7時間勉強する！" value="{{ $plan_form->title }}">
        </div>
    </div>
    <div class="row my-3">
          <div class="col-md-4">
            <h4>期間</h4>
            始める日
            <div>
            <datepicker-component name="start_date" defaultdate="{{ \Carbon\Carbon::now()->addDay("0")->format("Y/m/d") }}"/>
            </div>
            終わりの日
            <div>
            <datepicker-component name="end_date" defaultdate="{{ \Carbon\Carbon::now()->addDay("1")->format("Y/m/d") }}"/>
            </div>
            <!-- コントローラーに日付の計算で組む今日＋ userからもらった数字Carbonを利用 -->
          </div>
          <div class="col-md-4">
            <h4>報酬設定</h4>
            <br>
              <select name="user_point" id="" class="form-control">
                <option value="">選択して下さい</option>
                @for ($i = 1; $i <= 100; $i++)
                  <option value="{{ $i }}"
                    >{{ $i . 'point'}}
                  </option>
                @endfor
              </select>
              @if ($errors->has('point'))
                <span class="help-block">
                  <strong>{{ $errors->first('point') }}</strong>
                </span>
              @endif
          </div>
          <div class="col-md-4">
            <h4>減点設定or失敗したらする事</h4>
            <br>
            <select name="death_point" id="" class="form-control">
              <option value="">選択して下さい</option>
              @for ($i = 50; $i <= 100; $i++)
                <option value="{{ $i }}"
                  select>{{'-'. $i . 'point'}}
                </option>
              @endfor
            </select>
            <h5 class="mt-3">代償罰</h5>
            <input class="form-control" type="text" name="" value="">
          </div>
      </div>
      @csrf
      <input type="hidden" name="public" value="1">
      <input type="hidden" name="id" value="{{ $plan_form->id }}">
      <input class="btn btn-primary" style="margin-top: 250px;" type="submit" value="公開する">
      </form>
  </div>
@endsection

@section('js')
<script>
  $(function() {
    $("#test").click(function() {
    let random = Math.floor( Math.random() * 90 ) + 10;
      $("#view").append(random);
    });
  });
  function check(){
  if(window.confirm('本当に実行しますか？※一度作成したら編集できません')){ // 確認ダイアログを表示
      return true; // 「OK」時は送信を実行
  }
  else{ // 「キャンセル」時の処理
  // 警告ダイアログを表示
      return false; // 送信を中止
  }
}

</script>
@endsection
