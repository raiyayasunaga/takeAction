@extends('layouts.main')
 
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        </div>
    </div>
 
    {{--  チャットルーム  --}}
    <div id="room">
        @foreach($messages as $key => $message)
            {{--   送信したメッセージ  --}}
            @if($message->send == \Illuminate\Support\Facades\Auth::id())
                <div class="send" style="text-align: right">
                    <p>投稿者：{{ Auth::user()->name }}</p>
                    <div class="faceicon">
                    </div>
                    <div class="chatting">
                      <p class="send_message">{{$message->message}}</p>
                    </div>
                </div>
 
            @endif
 
            {{--   受信したメッセージ  --}} 
            @if($message->recieve == \Illuminate\Support\Facades\Auth::id())
                <div class="recieve" style="text-align: left">
                  <p>送る人：</p>
                  <div class="faceicon">
                  </div>
                  <div class="chatting">
                    <p class="recieve_messege" >{{$message->message}}</p>
                  </div>
                </div>
            @endif
        @endforeach
    </div>
 
    <form>
        <textarea name="message" style="width:100%; overflow: hidden;"></textarea>
        <input class="btn btn-primary" type="submit" id="btn_send" onclick="window.location.reload();" value="送信する">
    </form>
 
    <input type="hidden" name="send" value="{{$param['send']}}">
    <input type="hidden" name="recieve" value="{{$param['recieve']}}">
    <input type="hidden" name="login" value="{{\Illuminate\Support\Facades\Auth::id()}}">
 
</div>
 
@endsection

@section('js')
    <script type="text/javascript">
      window.onload = function(){
       //ログを有効にする
       Pusher.logToConsole = true;
 
       var pusher = new Pusher('[YOUR-APP-KEY]', {
           cluster  : '[YOUR-CLUSTER]',
           encrypted: true
       });
 
       //購読するチャンネルを指定
       var pusherChannel = pusher.subscribe('chat');
 
       //イベントを受信したら、下記処理
       pusherChannel.bind('chat_event', function(data) {
 
           let appendText;
           let login = $('input[name="login"]').val();
 
           if(data.send === login){
               appendText = '<div class="send" style="text-align:right"><p>' + data.message + '</p></div> ';
           }else if(data.recieve === login){
               appendText = '<div class="recieve" style="text-align:left"><p>' + data.message + '</p></div> ';
           }else{
               return false;
           }
 
           // メッセージを表示
           $("#room").append(appendText);
 
           if(data.recieve === login){
               // ブラウザへプッシュ通知
               Push.create("新着メッセージ",
                   {
                       body: data.message,
                       timeout: 8000,
                       onClick: function () {
                           window.focus();
                           this.close();
                       }
                   })
 
           }
 
 
       });
 
 
        $.ajaxSetup({
            headers : {
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content'),
            }});
 
 
        // メッセージ送信
        $('#btn_send').on('click' , function(){
            $.ajax({
                type : 'POST',
                url : '/chat/send',
                data : {
                    message : $('textarea[name="message"]').val(),
                    send : $('input[name="send"]').val(),
                    recieve : $('input[name="recieve"]').val(),
                }
            }).done(function(result){
                $('textarea[name="message"]').val('');
            }).fail(function(result){
 
            });
        });
      };
    </script>
 
@endsection