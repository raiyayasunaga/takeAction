<?php

namespace App\Http\Controllers;

use App\Action;
use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Reward;
use Carbon\Carbon;
use Auth;

class ActionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 降順orderByで
        $posts = Post::orderBy('id', 'desc')->get();

        return view('admin.home', ['posts' => $posts]);
    }

    public function mypage() 
    {
        $posts = Post::all();

        return view('admin.mypage', ['posts' => $posts]);
    }

    public function reward() 
    {
        $rewards = Reward::all();

        return view('admin.reward', ['rewards' => $rewards]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, Post::$rules);
        $post = new Post;
        $post->period = Carbon::now('Asia/Tokyo')->addDays($request->period);
        $post->fill($request->except(['_token', 'period']));
        $post->save();

        session()->flash('flash_message', '投稿が完了しました');
        return redirect('admin');
    }

    public function pointget(Request $request)
    {
        Auth::user()->point += $request->user_point;
        Auth::user()->update();
        Post::find($request->id)->delete();

        return redirect('admin');
    }

    public function pointless(Request $request)
    {
        Auth::user()->point -= $request->death_point;
        Auth::user()->update();
        Post::find($request->id)->delete();

        return redirect('admin');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function mypageedit()
    {
        return view('admin.mypageedit');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Action  $action
     * @return \Illuminate\Http\Response
     */
    public function show(Action $action)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Action  $action
     * @return \Illuminate\Http\Response
     */
    public function edit(Action $action)
    {
        return view('admin.edit', ['action' => $action]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Action  $action
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Action $action)
    {
        $action = $request->all();
        $action->save();
        return redirect('admin/'.$action->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Action  $action
     * @return \Illuminate\Http\Response
     */
    // 消去機能は基本的に使わない方針で
    public function destroy(Action $action)
    {
         $action->delete();
         return redirect('admin');
    }
}
