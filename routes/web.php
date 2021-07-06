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

Route::prefix('admin')->group(function () {
    Route::get('mypage', 'ActionController@mypage')->name('admin.mypage');
    Route::get('reward', 'ActionController@reward')->name('admin.reward');
    Route::get('users', 'ActionController@users')->name('admin.users');
    Route::get('usershow', 'ActionController@usershow')->name('admin.usershow');
    
    Route::get('reward_create', function() {
        return view('admin.reward_create');
    })->name('admin.reward_create');
    Route::get('mypageedit', 'ActionController@mypageedit');
    Route::post('mypagecreate', 'ActionController@mypagecreate');

    Route::post('pointget', 'ActionController@pointget');
    Route::post('pointless', 'ActionController@pointless');

    Route::post('rewardscreate', 'ActionController@rewardcreate');
    Route::post('rewardsget', 'ActionController@rewardsget');

    // コントローラーに書くの面倒からここに書いた
    Route::get('reward_edit', function(Request $request) {
        $reward_form = Reward::find($request->id);

        return view('admin.reward_edit', ['reward_form' => $reward_form]);
    })->name('reward.edit');
    Route::post('reward_update', 'ActionController@rewardupdate');

    // 履歴データを消去
    Route::post('delete', 'ActionController@delete')->name('notices.delete');

    Route::get('test', function() {
        return view('admin.test');
    });
});

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
