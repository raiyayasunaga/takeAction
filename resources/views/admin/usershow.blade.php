@extends('layouts.main')

@section('title', 'ユーザー情報')

@section('content')
{{ Breadcrumbs::render('users', $user)}}
  <div class="container">
    <h3>ユーザー詳細一覧</h3>
      <h4>{{ $user->name }}さんの投稿</h4>
    <div class="row">
      <table class="table">
          <thead>
            <tr>
              <th width="30%">投稿名</th>
              <th width="30%">期限</th>
              <th width="20%">ポイント</th>
              <th width="20%">-ポイント</th>
            </tr>
          </thead>
        @foreach($posts as $post)
          @if($post->public == 1)
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
          @endif
        @endforeach
      </table>
        <div class="col-5">
          
        </div>
    </div>
  </div>
@endsection
