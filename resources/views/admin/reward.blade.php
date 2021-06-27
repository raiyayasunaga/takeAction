@extends('layouts.main')

@section('title', 'ご褒美一覧')

@section('content')
  <div class="container">
  <h2>ご褒美一覧</h2>
    <div class="row">
      <form action="{{ action('ActionController@reward') }}">
        <div class="col-8">
        </div>
      </form>
    </div>
    <div class="row">
      <p>敢えてデータを手入力で挿入させる</p>
        <table class="table">
          <thead>
              <tr>
                  <th width="80%">褒美タイトル</th>
                  <th width="20%">ポイント数</th>
              </tr>
          </thead>
          <tbody>
            @foreach($rewards as $rewad)
              <tr>
                  <td>{{ $rewad->title }}</td>
                  <td><a href ="#">{{ $rewad->point }}</a></td>
              </tr>
            @endforeach
          </tbody>
      </table>
    </div>
  </div>
@endsection

