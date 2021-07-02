@extends('layouts.main')

@section('title', 'mypage画面')

@section('content')
  <div class="container">
    <h3 class="mb-5"><a href="mypageedit">マイページの設定</a></h3>
    <div class="row mt-5">
    <h3>購入履歴</h3>
      <table class="table">
        <thead>
          <tr>
            <th width="80%">タイトル</th>
            <th width="10%">有効期限</th>
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
        <div class="col">
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')

@endsection




