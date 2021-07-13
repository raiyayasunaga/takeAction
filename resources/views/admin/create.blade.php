@extends('layouts.main')

@section('title', '作成画面')

@section('content')
{{ Breadcrumbs::render('admin/create') }}
  <div class="container">
  <!-- autocomplete="off"で予測入力が消せる！！ -->
  <form action="{{ route('admin.store') }}" onSubmit="return check()" method="post" enctype="multipart/form-data" autocomplete="off">
    @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
    @endif
    <div class="row">
        <div class="col">
          <h2>課題作成画面</h2>
            <input type="text" name="title" class="form-control" placeholder="例：1日7時間勉強する！" value="{{ old('title') }}">
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
            <div>
              <input class="btn btn-primary" type="button" name="user_point" value="ポイントランダム" id="test">
              <div name="user_point" value="" id="view"></div>
              <input class="form-control" onclick="change()" name="user_point" type="button" value="クリックして下さい" id="myButton1" style=""></input>

              <!-- javascriptでvalue属性生成した数値を入れる -->
            </div>
              <select name="user_point" id="" class="form-control">
                <option value="">選択して下さい</option>
                @for ($i = 1; $i <= 100; $i++)
                  <option value="{{ $i }}"
                    @if(old('user_point') == $i) select @endif>{{ $i . 'point'}}
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
                    @if(old('death_point') == $i) select @endif>{{'-'. $i . 'point'}}
                  </option>
                @endfor
            </select>
            <h5 class="mt-3">代償罰</h5>
            <input class="form-control" type="text" name="" value="">
          </div>
      </div>

      <h3>公開設定</h3>
      <div class="row">
          <div class="col-3">
            <select name="public" id="" class="form-control">
              <option value="0">まだ開始しない</option>
              <option value="1">もう開始する</option>
            </select>
          </div>
      </div>
      @csrf
      <input type="hidden" id="place" name="user_point" value="">
      <input class="btn btn-primary" style="margin-top: 250px;" type="submit" value="新規追加">
      </form>
  </div>
@endsection

@section('js')
<script>
  $(function() {
    $("#test").click(function() {
    let test = document.getElementById("test");
    let random = Math.floor( Math.random() * 90 ) + 10;
    // input hidden formではinputのvalueが読み込まら流ので
    // val()jqueryで変数名に$はいらない。
    if(test.value == "") {
      test.value = "ポイントランダム";
    }
    else {
      test.value = "ポイントが入りました！";
      test.style.backgroundColor = "#3fb811";
      test.style.color = "white";
    }
      $("#place").val(random);
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

function change() //no ';' here
{
    var elem= document.getElementById("myButton1");
    if (elem.value=="") {
      elem.value= "クリックして下さい";
    }
    else {
      elem.value= "セット完了！";
        elem.style.backgroundColor = "#3fb811";
        elem.style.color = "white";
    }

}

</script>
@endsection
