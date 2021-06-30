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
        $posts = Post::where('user_id', Auth::id())
        ->orderBy('created_at', 'desc') 
            ->get();  

        return view('admin.home', ['posts' => $posts]);
    }

    public function mypage() 
    {
        $rewards = Reward::where('user_id', Auth::id())
        ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.mypage', ['rewards' => $rewards]);
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
        $post->user_id = Auth::id();
        $post->save();

        session()->flash('msg_success', '投稿が完了しました');
        return redirect('admin');
    }

    public function pointget(Request $request)
    {
        Auth::user()->point += $request->user_point;
        Auth::user()->update();
        Post::find($request->id)->delete();

        session()->flash('msg_success', 'クエスト完了しました');
        return redirect('admin');
    }

    public function pointless(Request $request)
    {
        Auth::user()->point -= $request->death_point;
        Auth::user()->update();
        Post::find($request->id)->delete();

        return redirect('admin');
    }

    public function reward() 
    {
        $rewards = Reward::all();

        return view('admin.reward', ['rewards' => $rewards]);
    }


    public function rewardcreate(Request $request)
    {
        $this->validate($request, Reward::$rules);
        $reward = new Reward;
        $form = $request->all();
        $reward->fill($form);
        $reward->save();

        session()->flash('msg_success', 'ご褒美内容が作成されました');
        return redirect('admin/reward');
    }


    public function rewardsget(Request $request)
    {
        $validate_rule = [
            'point' => 'integer|min: 1',
        ];
 
         $this->validate($request, $validate_rule);

        Auth::user()->point -= $request->reward_point;
        Auth::user()->update();
        Auth::user()->id = $request->user_id;

        session()->flash('msg_success', '購入完了！');
        return redirect('admin/reward');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function mypageedit(Request $request)
    {
        return view('admin.mypageedit');
    }

    public function mypagecreate(Request $request)
    {
        $profile = Auth::user();
        $form = $request->all();

        $profile->image_profile = $request->profile_image;
        $profile->name = $request->name;

        if(isset($form['image'])) {
            $path = $request->file('image')->store('public/img');
            $profile->image_profile = basename($path);
        } elseif ($request->file('image')) {
            $path = $request->file('image')->store('public/img');
            $profile->image_profile = basename($path);
        } else {
            $profile->image_profile = null;
        }

        $profile->fill($form)->save();

        session()->flash('msg_success', 'プロフィールを変更しました');
        return redirect('admin/mypage');
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
