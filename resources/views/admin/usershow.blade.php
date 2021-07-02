@extends('layouts.main')

@section('title', 'ユーザー情報')

@section('content')
  <div class="container">
    <h3>ユーザー詳細一覧</h3>
    <div class="row">
      <table class="table">
        @foreach($users as $user)
          <thead>
            <tr>
              <th>{{ $user->name }}さんの投稿</th>
              <th>獲得ポイント</th>
              <th>マイナスポイント</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>叱って貰うわ</td>
              <td>叱って貰うわ</td>
              <td>叱って貰うわ</td>
            </tr>
          </tbody>
        @endforeach
      </table>
        <div class="col-5">
          
        </div>
    </div>
  </div>
@endsection
