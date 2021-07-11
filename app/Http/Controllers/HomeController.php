<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Message;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
 
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
 
        $user = Auth::user();
 
        // ログイン者以外のユーザを取得する
        $users = User::where('id' ,'<>' , $user->id)->get();
        $message = Message::all();
        
        // チャットユーザ選択画面を表示
        return view('admin.chats.chatindex' , compact('users', 'message'));
    }
    public function return()
    {
        return redirect('admin.chats.chatindex');
    }
}
