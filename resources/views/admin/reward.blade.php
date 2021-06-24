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
        <table class="table">
          <thead>
              <tr>
                  <th width="80%">褒美タイトル</th>
                  <th width="20%">ポイント数</th>
              </tr>
          </thead>
          <tbody>
              <tr>
                  <td><a href ="#">タイトル</a></td>
                  <td><a href ="#">100</a></td>
              </tr>
          </tbody>
      </table>
    </div>
  </div>
@endsection

