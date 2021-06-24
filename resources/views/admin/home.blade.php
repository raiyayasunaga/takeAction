@extends('layouts.main')

@section('title', '作成画面')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col">
        <h3>今週の課題</h3>
        <h4>現在の獲得ポイント:300P</h4>
      </div>
    </div>
    <div class="row">
      <table class="table">
        <thead>
          <tr>
            <th width="60%">クエスト一覧</th>
            <th width="10%">期限</th>
            <th width="10%">GETポイント</th>
            <th width="20%">Deathポイント</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>タイトル</td>
            <td>後2日！</td>
            <td>100GET!!</td>
            <td>-100😞</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
@endsection
