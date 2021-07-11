@extends('layouts.main')

@section('title', '実行していない')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col">
        <h3>まだやっていない課題</h3>
      </div>
    </div>
    <div class="row">
      <table class="table">
        <thead>
          <tr>
            <th width="80%">クエスト一覧</th>
            <th width="20">公開するのか？</th>
          </tr>
        </thead>
        <tbody>
          @foreach(Auth::user()->posts as $post)
            @if($post->public == 0)
              <tr>
                <td>
                  {{ $post->title }}
                </td>
                <!-- route　対応ができない、直書きするのは弱い。 -->
                <td><a href="{{ route('planning.public', ['id' => $post->id]) }}">公開する</a></td>
              </tr>
            @endif
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection

@section('js')
  <script>

  </script>
@endsection
