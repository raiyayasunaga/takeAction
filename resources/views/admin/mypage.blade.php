@extends('layouts.main')

@section('title', 'mypage画面')

@section('content')
  <div class="container">
    <h3 class="mb-5"><a href="mypageedit">マイページの設定</a></h3>
    <h3 class="my-3">投稿画面の設定</h3>
    <div class="row">
      <table class="table">
        <thead>
          <tr>
            <th width="70%">タイトル</th>
            <th widht="10%">編集</th>
            <th width="10%">通知設定</th>
          </tr>
        </thead>
        <tbody>
          @foreach($posts as $post)
          <tr>
            <td>{{ $post->title }}</td>
            <td><a href="{{ route('admin.edit', $post->id) }}">編集</a></td>
            <td>通知設定</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection

@section('js')

@endsection




