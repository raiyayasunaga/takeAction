@extends('layouts.main')

@section('title', '作成画面')

@section('content')
  <div class="container">
  <!-- autocomplete="off"で予測入力が消せる！！ -->
  <form action="{{ route('admin.store') }}" onSubmit="return" method="post" enctype="multipart/form-data" autocomplete="off">
    @if (count($errors) > 0)
      <ul>
          @foreach($errors->all() as $e)
              <li>{{ $e }}</li>
          @endforeach
      </ul>
    @endif
    <div class="row">
        <div class="col">
          <h2>ムチ作成画面</h2>
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
            <h4>減点設定</h4>
            <br>
            <select name="death_point" id="" class="form-control">
              <option value="">選択して下さい</option>
              @for ($i = 1; $i <= 100; $i++)
                <option value="{{ $i }}"
                  @if(old('death_point') == $i) select @endif>{{'-'. $i . 'point'}}
                </option>
              @endfor
            </select>
          </div>
      </div>
      <div class="row">
      <h3>通知設定</h3>
        <select name="" id="">
          <option value="">通知する</option>
          <option value="">通知しない</option>
        </select>
      </div>
      @csrf
      <input style="margin-top: 250px;" type="submit" value="新規追加">
      </form>
  </div>
@endsection

@section('js')
<script>
window.onload = function()
{
  function recheck(){
    if(window.confirm('本当に実行してもよろしいですか？. '<br>' .＊消去編集できません')){ // 確認ダイアログを表示
        return true; // 「OK」時は送信を実行
    }
    else{ // 「キャンセル」時の処理
    // 警告ダイアログを表示
        return false; // 送信を中止
    }
  }
}
</script>
@endsection
