<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Http\Request;
use App\Reward;
use App\Post;
use App\User;

Route::prefix('admin')->group(function () {
    // get('URL')はここから読み込まれる

    // mypage一覧ルーティング
    Route::get('mypage', 'ActionController@mypage')->name('admin.mypage');
    Route::get('mypageedit', function() {

        return view('admin.mypageedit');
    })->name('admin.mypageedit');
    Route::post('mypagecreate', 'ActionController@mypagecreate');


    // reards一覧ルーティング
    Route::get('reward', function() {
        $rewards = Reward::all();

        return view('admin.rewards.reward', ['rewards' => $rewards]);
    })->name('admin.reward');

    Route::get('reward_create', function() {
        return view('admin.rewards.reward_create');
    })->name('admin.reward_create');
    Route::post('rewardscreate', 'ActionController@rewardcreate');
    Route::post('rewardsget', 'ActionController@rewardsget');

    Route::get('reward_edit', function(Request $request) {
        $reward_form = Reward::find($request->id);

        return view('admin.rewards.reward_edit', ['reward_form' => $reward_form]);
    })->name('reward.edit');
    Route::post('reward_update', 'ActionController@rewardupdate');


    // users一覧ルーティング
    Route::get('users', function() {
        $users = User::all();

        return view('admin.users', ['users' => $users]);
    })->name('admin.users');
    Route::get('usershow', 'ActionController@usershow')->name('admin.usershow');


    // ポイント上げたり下げたりするルーティング
    Route::post('pointget', 'ActionController@pointget');
    Route::post('pointless', 'ActionController@pointless');


    // 履歴データを消去、{{まだ不完全}}
    Route::post('delete', 'ActionController@delete')->name('notices.delete');

    
    // 証拠履歴、フォーム等ルート
    Route::get('verify_photo', function(Request $request) {
        $verify_form = Post::find($request->id);

        return view('admin.verify', ['verify_form' => $verify_form]);
    })->name('verify.form');


    Route::post('verifycreate', 'ActionController@verifycreate');

    // 投稿履歴
    Route::get('verified_photo', 'ActionController@verified')->name('admin.verified.photo');


    // 投稿保存、まだ開始していない課題など
    Route::get('actionplanning', function() {

        return view('admin.plannings.actionplanning');
    })->name('admin.actionplanning');

    Route::get('planningpublic/{post}', 'ActionController@planpublic')->name('admin.planning.public');

    
    Route::post('runpublic', 'ActionController@runpublic');


    // 色々試すところ
    Route::get('test', function() {
        return view('admin.test');
    });

});



//メッセージ送信機能 
Route::get('/chat/{recieve}' , 'ChatController@index')->name('chat');
Route::post('/chat/send' , 'ChatController@store')->name('chatSend');


// プッシュ通知機能
Route::get('web_push/create', 'WebPushController@create');
Route::post('web_push', 'WebPushController@store');

Route::get('web_push_test', function(){

    $users = \App\User::all();
    \Notification::send($users, new \App\Notifications\EventAdded());

});


Route::resource('admin', 'ActionController')->except([
    'edit','update', 'show', 'destory'
])->middleware('auth');

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
