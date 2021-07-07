<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Action;
use App\User;
use App\Post;
use App\Reward;
use App\Rewardrecord;
use App\Notice;
use App\VerifiedPhoto;

use Carbon\Carbon;
use Storage;
use Auth;
use OneSignal;

class ActionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  ホームページ
    public function index()
    {
        // 降順orderByで

        $posts = User::find('user_id');
        Auth::user()->posts;

        // $posts = Post::where('user_id', Auth::id())
        // ->orderBy('created_at', 'desc')
        // ->get();上野と何が違うのか、、

        // バッチcronで自動的に消去してくれる
            
        foreach(Auth::user()->posts as $post) {
            if($post->getendHours() == 0) {
                Auth::user()->point -= $post->death_point;
                Auth::user()->alert_level = "";
                Auth::user()->update();
                $post->delete();
            session()->flash('msg_success', '「'.$post->title . '」' . 'ミッション失敗しました');
            }
            elseif($post->getendDays() == 0) {
                if($post->getendHours() <= 24 && $post->getendHours() > 12) {
                    Auth::user()->alert_level = "2";
                    Auth::user()->update();
                session()->flash('msg_success', '投稿の期限が24時間切りました');
                }
                elseif($post->getendHours() <= 12 && $post->getendHours() > 0) {
                    Auth::user()->alert_level = "3";
                    Auth::user()->update();
                }
            }
            elseif($post->getendDays() == 1) {
                Auth::user()->alert_level = "1";
                Auth::user()->update();
            }
        }
        $posts = User::find('user_id');
        Auth::user()->posts;


        return view('admin.home', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  作成画面
    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, Post::$rules);
        $post = new Post;

        $post->period = Carbon::now('Asia/Tokyo');
        // dd($post->start_date);
        $post->start_date = new Carbon($request->start_date);
        $post->end_date = new Carbon($request->end_date);
        $post->fill($request->except(['_token', 'period', 'start_date', 'end_date']));
        $post->user_id = Auth::id();

        $post->save(); 

        $notice = new Notice;
        
        $notice->who = Auth::user()->name;
        $notice->popose = $request->title;
        $notice->action = "設定";
        
        $notice->save();

        // $message = OneSignal::sendNotificationToAll(
        //     "Some Message", 
        //     $url = null, 
        //     $data = null, 
        //     $buttons = null, 
        //     $schedule = null
        // );

        session()->flash('msg_success', '投稿が完了しました');
        return redirect('admin');
    }

    // ポイントクリア、諦めるの処理
    public function pointget(Request $request)
    {
        Auth::user()->point += $request->user_point;
        Auth::user()->alert_level = "NULL";
        Auth::user()->update();

        Post::find($request->id)->delete();

        session()->flash('msg_success', 'クエスト完了しました');
        return redirect('admin');
    }

    public function pointless(Request $request)
    {
        Auth::user()->point -= $request->death_point;
        Auth::user()->alert_level = "NULL";
        Auth::user()->update();
        Post::find($request->id)->delete();

        return redirect('admin');
    }


    // 褒美一覧
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
            'reward_point' => 'integer|max:'.Auth::user()->point,
            // titleを複数購入防ぐため
        ];
 
         $this->validate($request, $validate_rule);
        Auth::user()->point -= $request->reward_point;
        Auth::user()->update();

        $record = new Rewardrecord;
        $record->record_title = $request->title;
        $record->user_id = Auth::id();
        $record->reward_period = Carbon::now();
        $record->save();

        // ユーザーのIDとリワードID購入履歴

     ;   session()->flash('msg_success', '購入完了！');
        return redirect('admin/reward');
    }

    public function rewardupdate(Request $request)
    {
        $reward = Reward::find($request->id);
        $form = $request->all();
        $reward->fill($form);
        $reward->save();

        session()->flash('msg_seccess', 'ご褒美内容を編集しました');
        return redirect('admin/reward');
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //  マイページの処理
    public function mypage() 
    {
        $rewards = Rewardrecord::where('user_id', Auth::id())
        ->orderBy('created_at', 'desc')
        ->get();
        
        foreach($rewards as $reward) {
            if($reward->getRemaindingDays() == 0) {
                $reward->delete();
                Auth::user()->alert_level = "NULL";
                Auth::user()->update();
            session()->flash('msg_success', '有効期限が過ぎました');
            }
        }

        $notices = Notice::all();


        $rewards = Rewardrecord::where('user_id', Auth::id())
        ->orderBy('created_at', 'desc')
        ->get();

        return view('admin.mypage', ['rewards' => $rewards, 'notices' => $notices]);
    }

    public function mypageedit(Request $request)
    {
        return view('admin.mypageedit');
    }

    public function mypagecreate(Request $request)
    {
        $profile = Auth::user();
        $form = $request->all();

        $profile->purpose = $request->purpose;
        // dd$formで確認できてきているのかdd($form['image'])
        if(isset($form['image'])) {
            $path = Storage::disk('s3')->putFile('/',$form['image'],'public');
            // ddが通ってないdd($path)
            $profile->image_profile = Storage::disk('s3')->url($path);
        } elseif ($request->file('image')) {
            $path = Storage::disk('s3')->putFile('/', $form['image'], 'public');
            $profile->image_profile = Storage::disk('s3')->url($path);
        } else {
            $profile->image_profile = $request->image_profile;
        }

        unset($form['_token']);
        unset($form['image']);

        $profile->fill($form)->save();

        session()->flash('msg_success', 'プロフィールを変更しました');
        return redirect('admin/mypage');
    }


    // ユーザー一覧
    public function users() 
    {
        $users = User::all();

        return view('admin.users', ['users' => $users]);
    }

    public function usershow(Request $request)
    {
        // ユーザー個別の情報を表示
        // User_idが渡されていないので、、
        $users = User::find($request->id);
        $posts = Post::where('user_id', $users->id)
        ->orderBy('created_at', 'desc') 
            ->get();

        return view('admin.usershow', ['posts' => $posts, 'users' => $users]);
    }

    public function delete(Request $request)
    {
        $notice = Notice::all();
        $notice->delete();   

        return redirect('admin.mypage');
    }


    // 写真で確認して記録する
    public function verifycreate(Request $request)
    {
        // エラーが起こる原因は大体idを持って来れているのかどうかで決まる。
            Auth::user()->point += $request->user_point;
            Auth::user()->alert_level = "NULL";
            Auth::user()->update();

            Post::find($request->id)->delete();

            $verify = new VerifiedPhoto;
            $verify->photo_id = Auth::id();
            $verify->photo_title = $request->photo_title;
            $form = $request->all();

            // 商品情報の保存
            if(isset($form['image'])) {
                $path = Storage::disk('s3')->putFile('/',$form['image'],'public');
                // ddが通ってないdd($path)
                $verify->image_path = Storage::disk('s3')->url($path);
            } else {
                $verify->image_path = $request->image_path;
            }

            unset($form['_token']);
            unset($form['image']);

            $verify->fill($form)->save();

            session()->flash('msg_success', 'クエストが完了しました！');
            return redirect('admin');
    }

    public function verified()
    {
        $verified = verifiedPhoto::where('photo_id', Auth::id())->get();
        
        return view('admin.verified_show', ['verified_photos' => $verified]);
    }


















































// 以下のコードはresourceで定義された必要のないコードなので、、

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
