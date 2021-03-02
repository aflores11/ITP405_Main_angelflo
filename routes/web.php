<?php

use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\TrackController;
use App\Http\Controllers\AlbumController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

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
if (env('APP_ENV') !== 'local') {
    URL::forceScheme('https');
}


Route::get('/', [PlaylistController::class, 'index'])->name('playlist.index');

Route::get('/tracks', [TrackController::class, 'index'])->name('track.index');
Route::get('/tracks/new', [TrackController::class, 'new'])->name('track.new');
Route::post('/tracks', [TrackController::class, 'store'])->name('track.store');

Route::get('/playlists', [PlaylistController::class, 'index'])->name('playlist.index');
Route::get('/playlists/{id}', [PlaylistController::class, 'show'])->name('playlist.show');
Route::get('/playlists/{id}/edit', [PlaylistController::class, 'edit'])->name('playlist.edit');
Route::post('/playlists/{id}', [PlaylistController::class, 'update'])->name('playlist.update');

// old albums
Route::get('/albums_old', [AlbumController::class, 'index'])->name('album.index');
Route::get('/albums_old/create', [AlbumController::class, 'create'])->name('album.create');
Route::post('/albums_old', [AlbumController::class, 'store'])->name('album.store');
Route::get('/albums_old/{id}/edit', [AlbumController::class, 'edit'])->name('album.edit');
Route::post('/albums_old/{id}', [AlbumController::class, 'update'])->name('album.update');

//using eloquent
Route::get('/albums', [AlbumController::class, 'eloquent_index'])->name('album.eloquent.index');
Route::post('/albums', [AlbumController::class, 'eloquent_store'])->name('album.eloquent.store');
Route::get('/albums/{id}/edit', [AlbumController::class, 'eloquent_edit'])->name('album.eloquent.edit');
Route::get('/albums/create', [AlbumController::class, 'eloquent_create'])->name('album.eloquent.create');
Route::post('/albums/{id}', [AlbumController::class, 'eloquent_update'])->name('album.eloquent.update');