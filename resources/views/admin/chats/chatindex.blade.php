@extends('layouts.main')
 
@section('title', 'チャット画面')

@section('style')
<script src="https://cdn.jsdelivr.net/npm/vue-notification-bell@0.8.14/dist/NotificationBell.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
@endsection

@section('content')
<div class="container">
  <!-- メッセージリスト -->
  <div class="messaging">
   @if(isset($room))
     <message-list login_user_id="{{Auth::id()}}" redirect_room_id="{{$room->room_id}}"></message-list>
   @else
     <message-list login_user_id="{{Auth::id()}}"></message-list>
   @endif
 </div>
    {{--  チャット可能ユーザ一覧  --}}
    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $key => $user)
        <tr>
            <!-- <th>{{$loop->iteration}}</th> -->
            <td>{{$user->name}}</td>
            <td class="message_tem"><a href="/chat/{{$user->id}}"><button type="button" class="btn btn-primary">Chat</button></a></td>
            <td class="message_notice">メッセージが届いています</td>
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

