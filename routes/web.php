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

Route::prefix('admin')->group(function () {
    Route::get('mypage', 'ActionController@mypage')->name('admin.mypage');
    Route::get('reward', 'ActionController@reward')->name('admin.reward');
    Route::get('reward_create', function (Request $request) {
        return view('admin.reward_create');
    })->name('admin.reward_create');
    Route::get('mypageedit', 'ActionController@mypageedit');
    Route::post('pointget', 'ActionController@pointget');
    Route::post('pointless', 'ActionController@pointless');

    Route::post('rewardscreate', 'ActionController@rewardcreate');
    Route::post('rewardsget', 'ActionController@rewardsget');

    Route::post('mypagecreate', 'ActionController@mypagecreate');
});

Route::get('web_push/create', 'WebPushController@create');
Route::post('web_push', 'WebPushController@store');

Route::get('web_push_test', function(){

    $users = \App\User::all();
    \Notification::send($users, new \App\Notifications\EventAdded());

});

Route::resource('admin', 'ActionController')->middleware('auth');

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
