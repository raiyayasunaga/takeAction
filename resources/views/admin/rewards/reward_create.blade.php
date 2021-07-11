@extends('layouts.main')

@section('title', 'ご褒美作成')

@section('content')
  <div class="container">
    <form action="{{ action('ActionController@rewardcreate') }}" onSubmit="return recheck()" method="post" enctype="multipart/form-data">
    @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
    @endif
    <h3>ご褒美作成</h3>
      <div class="row">
        <div class="col-md-12">
          <input type="text" name="title" class="form-control" placeholder="できるだけ細かく記述して下さい" value="{{ old('title') }}">
        </div>
      </div>
      <div class="row my-5">
        <div class="col-md-6">
          <h4>報酬設定</h4>
            <input type="text" class="form-control" name="reward_point" placeholder="数式のみ" id="" vlaue="">
        </div>
        <div class="col-md-3">
          <h4>有効期限の設定</h4>
          <select class="form-control" name="time" id="">
            <option value="">選択して下さい</option>
              @for ($i = 1; $i <= 24; $i++)
                <option value="{{ $i }}"
                  >{{ $i . '時間'}}
                </option>
              @endfor
          </select>
        </div>
      </div>
      @csrf
      <input class="btn btn-success" type="submit" value="作成する">
    </form>
  </div>
@endsection

@section('js')
<script>
  function recheck() 
  {
    if(window.confirm('本当に実行してもよろしいですか？')){ // 確認ダイアログを表示
      return true; // 「OK」時は送信を実行
    }
    else{ // 「キャンセル」時の処理
    // 警告ダイアログを表示
        return false; // 送信を中止
    }
  }
</script>
@endsection
