<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\contractController;
use App\Http\Controllers\userProfileController;
use App\Http\Controllers\illustController;
use App\Http\Livewire\Contract\Index;

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

Auth::routes();

//Dashborad
Route::get('/', function () {
    return redirect()->route('home');
});
Route::get('/home',[userProfileController::class, 'showDashBorad'])->name('home'); //初期表示
Route::post('/search',[userProfileController::class, 'serachDashBorad'])->name('serachDashBorad'); //検索
Route::get('/search', function () { //検索 バリデーション弾いたとき、getで画面をリロードする為。
    return redirect()->route('home');
});

Route::group(['middleware' => 'auth'], function(){
    //契約
    Route::resource('contract', contractController::class, ['except' => ['show']]);

    //プロフィール画面表示
    Route::get('/profile',[userProfileController::class, 'showProfile'])->name('profile');
    //プロフィール画面 ajax
    Route::post('/ajaxTable',[userProfileController::class, 'ajaxTable'])->name('ajaxTable');

    //パスワード変更画面表示
    Route::get('/changePassword',[userProfileController::class, 'showChangePassword'])->name('showPassword');
    Route::put('/updateChangePassword',[userProfileController::class, 'changePassword'])->name('changePassword');

    //名前変更画面
    Route::get('/changeUserName',[userProfileController::class, 'showChangeName'])->name('showUserName');
    Route::put('/updateChangeUserName',[userProfileController::class, 'changeName'])->name('changeName');

    //イラスト系
    Route::get('/illustLists',[illustController::class, 'showIllustDisplay'])->name('showIllustDisplay');
    Route::post('/uploadIllust',[illustController::class, 'uploadIllust']);
    Route::delete('/deleteIllust/{id}',[illustController::class, 'deleteIllust'])->name('deleteIllust');
    Route::get('/showEditIllust/{id}',[illustController::class, 'showEditIllust'])->name('showEditIllust');
    Route::put('/updateIllust/{id}',[illustController::class, 'updateIllust'])->name('updateIllust');
    //イラストコメント系
    Route::get('/commentIllust/{id}',[illustController::class, 'showCommentIllust'])->name('showCommentIllust');
    Route::post('/storeCommentIllust/{id}',[illustController::class, 'storeComment'])->name('storeCommentIllust');
    Route::delete('/deleteCommentIllust/{comment_id}/{illust_id}',[illustController::class, 'deleteComment'])->name('deleteCommentIllust');
    Route::get('/showEditComment/{id}',[illustController::class, 'showEditComment'])->name('showEditComment');
    Route::put('/editCommentIllust/{id}',[illustController::class, 'editCommentIllust'])->name('editCommentIllust');

    //Livewire
    Route::get('/livewire',Index::class);
});