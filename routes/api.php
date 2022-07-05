<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\MusicianController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\PlaylistMusicController;
use App\Http\Controllers\MusicPlayHistoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);

// Route::group(['middleware' => ['jwt.verify']], function() {

    Route::get('album', [AlbumController::class, 'getAll']);
    Route::get('album/{id}', [AlbumController::class, 'getById']);
    Route::post('album', [AlbumController::class, 'store']);
    Route::put('album/{id}', [AlbumController::class, 'update']);
    Route::delete('album/{id}', [AlbumController::class, 'delete']);
    
    Route::get('musician', [MusicianController::class, 'getAll']);
    Route::get('musician/{id}', [MusicianController::class, 'getById']);
    Route::post('musician', [MusicianController::class, 'store']);
    Route::put('musician/{id}', [MusicianController::class, 'update']);
    Route::delete('musician/{id}', [MusicianController::class, 'delete']);
    
    Route::get('music', [MusicController::class, 'getAll']);
    Route::get('music/{id}', [MusicController::class, 'getById']);
    Route::post('music', [MusicController::class, 'store']);
    Route::put('music/{id}', [MusicController::class, 'update']);
    Route::delete('music/{id}', [MusicController::class, 'delete']);
    
    Route::get('playlist', [PlaylistController::class, 'getAll']);
    Route::get('playlist/{id}', [PlaylistController::class, 'getById']);
    Route::post('playlist', [PlaylistController::class, 'store']);
    Route::put('playlist/{id}', [PlaylistController::class, 'update']);
    Route::delete('playlist/{id}', [PlaylistController::class, 'delete']);
    
    Route::get('playlistmusic', [PlaylistMusicController::class, 'getAll']);
    Route::get('playlistmusic/{id}', [PlaylistMusicController::class, 'getById']);
    Route::post('playlistmusic', [PlaylistMusicController::class, 'store']);
    Route::put('playlistmusic/{id}', [PlaylistMusicController::class, 'update']);
    Route::delete('playlistmusic/{id}', [PlaylistMusicController::class, 'delete']);
    
    Route::get('musicplayhistory', [MusicPlayHistoryController::class, 'getAll']);
    Route::get('musicplayhistory/{id}', [MusicPlayHistoryController::class, 'getById']);
    Route::post('musicplayhistory', [MusicPlayHistoryController::class, 'store']);
    Route::put('musicplayhistory/{id}', [MusicPlayHistoryController::class, 'update']);
    Route::delete('musicplayhistory/{id}', [MusicPlayHistoryController::class, 'delete']);
    
    Route::get('likes', [LikesController::class, 'getAll']);
    Route::get('likes/{id}', [LikesController::class, 'getById']);
    Route::post('likes', [LikesController::class, 'store']);
    Route::put('likes/{id}', [LikesController::class, 'update']);
    Route::delete('likes/{id}', [LikesController::class, 'delete']);

// });