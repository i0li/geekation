<?php

use Illuminate\Support\Facades\Route;

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
    return view('auth/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/create_room', [App\Http\Controllers\Room\CreateRoomController::class, 'index']);
Route::post('/create_room', [App\Http\Controllers\Room\CreateRoomController::class, 'register']);

Route::post('/edit_room', [App\Http\Controllers\Room\EditRoomController::class, 'index']);
Route::post('/edit_exec', [App\Http\Controllers\Room\EditRoomController::class, 'update']);

Route::post('/delete_exec', [App\Http\Controllers\Room\DeleteRoomController::class, 'delete']);

Route::get('/in_room_home', [App\Http\Controllers\InRoom\InRoomHomeController::class, 'index']);
Route::post('/in_room_home', [App\Http\Controllers\InRoom\InRoomHomeController::class, 'index']);

Route::post('/create_word', [App\Http\Controllers\InRoom\Word\CreateWordController::class, 'register']);

Route::post('/edit_word', [App\Http\Controllers\InRoom\Word\EditWordController::class, 'update']);

Route::post('/delete_word', [App\Http\Controllers\InRoom\Word\DeleteWordController::class, 'delete']);


Route::post('/send_chat', [App\Http\Controllers\InRoom\Chat\SendChatController::class, 'register']);



