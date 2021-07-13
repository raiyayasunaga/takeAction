@extends('layouts.main')

@section('title', 'ユーザー一覧')

@section('content')
  {{ Breadcrumbs::render('admin.users') }}
  <div class="container">
    <div class="row">
      <div class="col">
        <h2>ユーザー一覧</h2>
      </div>
    </div>
    <div class="row">
    <!-- classにtableめっちゃ重要 -->
      <table class="table">
        <thead>
          <tr>
            <th width="30%">ユーザー名</th>
            <th width="40%">一言目標</th>
            <th width="30%">point数</th>
          </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
          <tr>
            <td><a href="{{ route('admin.usershow', ['id' => $user->id])}}">{{ $user->name }}</a></td>
            <td>{{ $user->purpose }}</td>
            <td>{{ $user->point }}</td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection

@section('js')

@endsection
