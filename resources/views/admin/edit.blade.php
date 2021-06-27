@extends('layouts.main')

@section('title', '編集画面')

@section('content')
  <div class="container">
  <form action="{{ url('admin/'.$action->id) }}" method="post" enctype="multipart/form-data">
    @method('PUT')
    <div class="row">
        <div class="col">
          <h2>ムチ編集画面</h2>
            <input type="text" name="title" class="form-control" value="{{ $action->title }}">
        </div>
    </div>
    <div class="row my-3">
          <div class="col-md-4">
            <h4>期間編集</h4>
              <select id="period" class="form-control" name="period">
                  <option value="">選択して下さい</option>
                  @for ($i = 1; $i <= 10; $i++)
                      <option value="{{ $i }}"
                              @if(old('period') == $i) selected @endif>{{ $i . '日間' }}</option>
                  @endfor
              </select>
              @if ($errors->has('period'))
                  <span class="help-block">
                      <strong>{{ $errors->first('period') }}</strong>
                  </span>
              @endif
          </div>
          <div class="col-md-4">
            <h4>報酬編集設定</h4>
              <select name="user_point" id="" class="form-control">
                <option value="">選択して下さい</option>
                @for ($i = 1; $i <= 100; $i++)
                  <option value="{{ $i }}"
                    @if(old('user_point') == $i) select @endif>{{ $i . 'point'}}
                  </option>
                @endfor
              </select>
              @if ($errors->has('point'))
                <span class="help-block">
                  <strong>{{ $errors->first('point') }}</strong>
                </span>
              @endif
          </div>
          <div class="col-md-4">
            <h4>減点編集設定</h4>
            <select name="deathPoint" id="" class="form-control">
              <option value="">選択して下さい</option>
              @for ($i = 0; $i >= -100; $i--)
                <option value="{{ $i }}"
                  @if(old('deathPoint') == $i) select @endif>{{ $i . 'point'}}
                </option>
              @endfor
            </select>
          </div>
      </div>
      @csrf
      <input type="submit" value="新規追加">
      </form>
  </div>
@endsection

