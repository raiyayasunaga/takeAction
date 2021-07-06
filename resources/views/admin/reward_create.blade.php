@extends('layouts.main')

@section('title', 'ご褒美作成')

@section('content')
  <div class="container">
    <form action="{{ action('ActionController@rewardcreate') }}" onSubmit="return recheck()" method="post" enctype="multipart/form-data">
    @if (count($errors) > 0)
      <ul>
        @foreach($errors->all() as $e)
          <li>{{ $e }}</li>
        @endforeach
      </ul>
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
            <select name="reward_point" id="" class="form-control" value="{{ old('reward_point') }}">
              <option value="{{ old('reward_point') }}">----</option>
              @for ($i = 1; $i <= 100; $i++)
                <option value="{{ $i }}">
                {{ $i . 'point' }}
                </option>
              @endfor
            </select>
        </div>
      </div>
      @csrf
      <input type="submit" value="作成する">
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
