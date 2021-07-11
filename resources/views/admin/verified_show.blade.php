@extends('layouts.main')

@section('title', 'ユーザーの証拠履歴画面')

@section('content')
<div class="container">
    <div class="row mt-5">
      <h3>これまでの投稿履歴</h3>
      <table class="table">
        <thead>
          <tr>
            <th width="80%">タイトル</th>
            <th width="20%">日付</th>
          </tr>
        </thead>
        <tbody>
          @foreach($verified_photos as $verified_photo)
            <tr>
              <td>
                <h4>{{ $verified_photo->photo_title }}</h4>
                <div class="display_normal"><img src="{{ $verified_photo->image_path }}" height="200px;"></div> 
                <div id="display_show" style="display: none"><img src="{{ $verified_photo->image_path }}" height="300px;"></div>
              </td>
              <td>{{ preg_replace("/:[0-5][0-9]| \w\w/", "",$verified_photo->created_at) }}日</td>
            </tr>
          @endforeach
        </tbody>
      </table>
      </div>
    </div>
  </div>
@endsection

@section('js')
<script type="text/javascript">
    
</script>
@endsection
