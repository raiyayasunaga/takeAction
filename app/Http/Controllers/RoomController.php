<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class RoomController extends Controller
{
    public function index(User $user, Request $request)
   {
       $all = Session::all();
       
       // リダイレクトされている場合かチェックしている
       if(isset($all['room'])) {
           $go_room = $all['room'];
           // 一度使うと消えるように設定
           Session::forget('room');
           return view('rooms.index')->with('room', $go_room);
       } else {
           return view('rooms.index');
       }
   }

   public function room_redirect(User $user, User $another_user)
   {
       $room = $user->getRoom($user->id, $another_user->id);
       // リダイレクトでsessionに渡している。withだとうまくいかなかった。
       Session::put('room', $room);
       return redirect()->route('message_room_list', ['user' => $user->id]);
   }

   public function room_list_get(User $user)
   {
       $rooms = $user->rooms()->get();
       foreach($rooms as $room) {
           $ids = [$user->id];
           $room_user = $room->users()->whereNotIn('user_id', $ids)->first();
           $room->user = $room_user;
           $room_last_message = $room->messages()->latest()->first();
           $room->last_message = $room_last_message;
       }
       return $rooms;
   }

   public function room_get(User $user, Room $room)
   {
       $room_user = $user->getRoom_byid($user->id, $room->id);
       return $room_user;
       
   }


   public function create(User $user)
   {
       $login_user = Auth::user();
       if(!$login_user->isMessaged(Auth::id(), $user->id)) {
           $room = new Room();
           $hash = $login_user->id + $user->id;
           $room->name = Hash::make($hash);
           $room->save();
           $room->users()->attach([$login_user->id, $user->id]);
           return $user->id;
           // return redirect()->route('message_room_redirect', ['user' => $login_user->id, 'another_user' => $user->id]);
       }
   }
}
