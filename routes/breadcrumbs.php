<?php

// home
Breadcrumbs::for('admin', function ($trail) {
  $trail->push('ホームページ', url('admin'));
});

// 課題作成
Breadcrumbs::for('admin/create', function ($trail) {
  $trail->push('課題作成', url('admin/create'));
});

// ご褒美一覧
Breadcrumbs::for('admin/reward', function ($trail) {
  $trail->push('ご褒美一覧', url('admin/reward'));
});

// ご褒美作成
Breadcrumbs::for('admin.reward_create', function($trail) {
  $trail->push('ご褒美作成', route('admin.reward_create'));
});



// mypage
Breadcrumbs::for('admin.mypage', function ($trail) {
    $trail->push('マイページ', route('admin.mypage'));
});

// mypage->verifyed.photo
Breadcrumbs::for('admin.verified.photo', function ($trail) {
    $trail->parent('admin.mypage');
    $trail->push('投稿履歴管理', route('admin.verified.photo'));
});
 
// mypage->mypageedit
Breadcrumbs::for('admin.mypageedit', function($trail) {
  $trail->parent('admin.mypage');
  $trail->push('マイページ編集', route('admin.mypageedit'));
});

// mypage->actionplanning
Breadcrumbs::for('admin.actionplanning', function ($trail) {
    $trail->parent('admin.mypage');
    $trail->push('まだ公開していない奴', route('admin.actionplanning'));
});

// mypage->actionplanning->publicplanning
Breadcrumbs::for('planningpublic', function ($trail, $posts) {
  $trail->parent('admin.actionplanning');
  $trail->push('ddm', url('planningpublic/' . $posts->id));
});


// users
Breadcrumbs::for('admin.users', function ($trail) {
  $trail->push('ユーザー一覧', route('admin.users'));
});


// users->usershow
Breadcrumbs::for('usershow', function($trail, $user) {
  $trail->parent('admin.user');
  $trail->push('ユーザー詳細', url('usershow?id=' . $user->id));
});


// chatちょっと難しい
Breadcrumbs::for('home', function($trail) {
  $trail->push('チャット一覧', url('home'));
});

// chat->idate
Breadcrumbs::for('chat', function($trail, $user) {
  $trail->parent('home');
  $trail->push($user->name .'さんとのチャット', url('chat/' . $user->id));
});

