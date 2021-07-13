@extends('layouts.main')

@section('title', 'mypage編集画面')

@section('content')
{{ Breadcrumbs::render('admin.mypageedit') }}
  <div class="container">
    <form action="{{ action('ActionController@mypagecreate') }}" method="post" enctype="multipart/form-data">
      <div class="row my-3">
        <h4>マイページ画像の設定</h4>
      </div>
      <div class="row my-3">
      <input type="file" name="img" id="image_profile" onchange="previewImage(this);">
      <div class="col-md-3">
        <img  src="{{ Auth::user()->image_profile }}" style="height: 100px; border: 1px solid black;">
      </div>
      <div class="col-md-1">
      <p>変更後</p>
      </div>
        <div class="col-md-3">
          <img  src="/img" id="Newimg" style="height: 200px; border: 1px solid black;">
        </div>
      </div>
      <div class="row my-3"> 
        <h4>名前の変更</h4>
        <div class="col-md-5">
          <input name="name" type="text" class="form-control" value="{{ Auth::user()->name }}">
        </div>
      </div>
      <div class="row my-3">
        <h4>一言目標</h4>
        <input name="purpose" type="text" class="form-control" value="{{ Auth::user()->purpose }}">
      </div>
      @csrf
      <input type="submit" value="変更する">
    </form>
  </div>
@endsection

@section('js')
<script>
    function previewImage(obj)
  {
    let fileReader = new FileReader();
    fileReader.onload = (function() {
      document.getElementById('Newimg').src = fileReader.result;
    });
    fileReader.readAsDataURL(obj.files[0]);
  }
</script>
@endsection

