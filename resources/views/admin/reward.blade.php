@extends('layouts.main')

@section('title', 'ご褒美一覧')

@section('content')
  <div class="container">
  <h2>ご褒美一覧</h2>
    <h3>現在のポイント数：{{ Auth::user()->point }}</h3>
    <div class="row">
        <table class="table">
          <thead>
              <tr>
                  <th width="80%">褒美タイトル</th>
                  <th width="20%">購入ポイント</th>
              </tr>
          </thead>
          <tbody>
          @if (count($errors) > 0)
                    <ul>
                      @foreach($errors->all() as $e)
                        <li>{{ $e }}</li>
                      @endforeach
                    </ul>
                  @endif
            @foreach($rewards as $reward)
              <tr>
                  <td>
                  <form method="post" action="{{ action('ActionController@rewardsget', ['id' => $reward->id]) }}" onSubmit="return check()">
                  <button type="submit" class="btn btn-primary p-1" style="text-align: start;">{{ $reward->title }}</button>
                  @csrf
                  <input type="hidden" name="reward_point" value="{{$reward->reward_point}}">
                  <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" id="">
                  <input type="hidden" name="title" value="{{ $reward->title }}" id="">
                </form>
                  <td>{{ $reward->reward_point }}</td>
              </tr>
            @endforeach
          </tbody>
      </table>
    </div>
  </div>
@endsection

@section('js')
<script>
  function check() {
    if(window.confirm(`本当にを購入してもよろしいですか？`)){ // 確認ダイアログを表示
      return true; // 「OK」時は送信を実行
    }
    else{ // 「キャンセル」時の処理
  // 警告ダイアログを表示
      return false; // 送信を中止
    }
  }
</script>

