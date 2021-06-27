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
    Route::get('mypageedit', 'ActionController@mypageedit');
    Route::post('pointget', 'ActionController@pointget');
    Route::post('pointless', 'ActionController@pointless');
});

Route::resource('admin', 'ActionController')->middleware('auth');

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
