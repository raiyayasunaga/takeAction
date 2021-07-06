@extends('layouts.main')

@section('title', 'ユーザー情報')

@section('content')
  <div class="container">
    <h3>ユーザー詳細一覧</h3>
      <h4>{{ $users->name }}さんの投稿</h4>
    <div class="row">
      <table class="table">
          <thead>
            <tr>
              <th width="30%">投稿名</th>
              <th width="30%">期限</th>
              <th width="10%">getポイント</th>
              <th width="10%">マイナスポイント</th>
            </tr>
          </thead>
        @foreach($posts as $post)
          <tbody>
            <tr>
              <td>{{ $post->title }}</td>
              @if($post->getstart() == 0)
                <td>{{ $post->getendDays() }}{{ $post->getendHours() }}</td>
                @elseif($post->getstart() > 0)
                <td>始まるまで後{{ $post->getstart() }}時間</td>
              @endif
              <td>{{ $post->user_point }}point</td>
              <td>-{{ $post->death_point }}point</td>
            </tr>
          </tbody>
        @endforeach
      </table>
        <div class="col-5">
          
        </div>
    </div>
  </div>
@endsection
