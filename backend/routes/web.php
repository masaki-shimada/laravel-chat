<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideoChatController;
use App\Http\Controllers\ChatController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => 'auth'], function(){
    Route::get('/video_chat', [VideoChatController::class, 'index']);
    Route::post('/auth/video_chat', [VideoChatController::class, 'auth']); // 認証ページ

    Route::get('/chat/', [ChatController::class, 'index']);
    Route::get('/chat/room/{user_id}', [ChatController::class, 'room']);
    Route::get('/chat/list', [ChatController::class, 'list']);
    Route::get('/chat/users', [ChatController::class, 'getUsers']);
    Route::get('/chat/messages', [ChatController::class, 'fetchMessages']);
    Route::post('/chat/messages', [ChatController::class, 'sendMessage']);
});

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
