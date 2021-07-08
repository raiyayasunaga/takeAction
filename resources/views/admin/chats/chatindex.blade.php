@extends('layouts.main')
 
@section('title', 'チャット画面')

@section('style')
<script src="https://cdn.jsdelivr.net/npm/vue-notification-bell@0.8.14/dist/NotificationBell.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
@endsection

@section('content')
<div class="container">
<div id="app">
      <notification-bell
        :size="100"
        :count="list.length"
        upper-limit="50"
        counter-location="upperRight"
        counter-style="roundRectangle"
        counter-background-color="#FF0000"
        counter-text-color="#FFFFFF"
        icon-color="#000000"
        font-size="25px"
        :animated="true"
      ></notification-bell>
      <ul class="list-group">
      <li class="list-group-item" v-for="(item, index) in list" :key="index"><button class="btn btn-danger" type="button" @click="deleteItem(index)">削除する</button></li>
      </ul>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
 
        </div>
    </div>
 
    {{--  チャット可能ユーザ一覧  --}}
    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $key => $user)
        <tr>
            <!-- <th>{{$loop->iteration}}</th> -->
            <td>{{$user->name}}</td>
            <td><a href="/chat/{{$user->id, $user->name}}"><button type="button" class="btn btn-primary">Chat</button></a></td>
        </tr>
        @endforeach
        </tbody>
    </table>
 
</div>
@endsection

@section('js')
    <script>
        const NotificationBell = window['NotificationBell'].default;
      new Vue({ 
        el: '#app',
        components: {
          'notification-bell':NotificationBell 
        },
        data: {
          list: [
            {no:1},
            {no:2},
            {no:3},
            {no:4},
            {no:5},
          ]
        },
        methods: {
          deleteItem: function(index){
            this.list.splice(index, 1);
          }
        }
      });
    </script>
@endsection

