@extends('layouts.main')

@section('title', '作成画面')

@section('content')
  <div class="container">
  <form action="{{ action('ActionController@new') }}" method="post" enctype="multipart/form-data">

    <div class="row">
        <div class="col">
          <h2>ムチ作成画面</h2>
            <input type="text" name="title" class="form-control" value="">
        </div>
    </div>
    <div class="row my-3">
          <div class="col-md-4">
            <h4>期間</h4>
              <select id="period" class="form-control" name="period">
                  <option value="">----</option>
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
            <h4>報酬設定</h4>
              <select name="point" id="" class="form-control">
                <option value="">----</option>
                @for ($i = 1; $i <= 100; $i++)
                  <option value="{{ $i }}"
                    @if(old('point') == $i) select @endif>{{ $i . 'point'}}
                  </option>
                @endfor
              </select>
              @if ($errors->has('point'))
                <span class="help-block">
                  <strong>{{ $errors->first('point') }}</strong>
                </span>
              @endif
          </div>
      </div>
      @csrf
      <input type="submit" value="新規追加">
      </form>
  </div>
@endsection

