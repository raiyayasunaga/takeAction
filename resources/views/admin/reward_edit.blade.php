@extends('layouts.main')

@section('title', 'ご褒美編集画面')

@section('content')
<div class="container">
  <form action="{{ action('ActionController@rewardupdate') }}" method="post" enctype="multipart/form-data">
    @if (count($errors) > 0)
      <ul>
        @foreach($errors->all() as $e)
          <li>{{ $e }}</li>
        @endforeach
      </ul>
    @endif
    <h3>ご褒美編集</h3>
      <div class="row">
        <div class="col-md-12">
          <input type="text" name="title" class="form-control" placeholder="できるだけ細かく記述して下さい" value="{{ $reward_form->title }}">
        </div>
      </div>
      <div class="row my-5">
        <div class="col-md-6">
          <h4>報酬設定</h4>
            <select name="reward_point" id="" class="form-control">
              <option value="">{{ $reward_form->reward_point }}point</option>
              @for ($i = 1; $i <= 100; $i++)
                <option value="{{ $i }}">
                {{ $i . 'point' }}
                </option>
              @endfor
            </select>
        </div>
      </div>
      @csrf
      <input type="submit" value="作成する">
    </from>
  </div>
@endsection