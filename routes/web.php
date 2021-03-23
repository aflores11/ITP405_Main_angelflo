<?php

use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\TrackController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ProfileController;
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


Route::get('/', [PlaylistController::class, 'home'])->name('home');

Route::get('/login',[AuthController::class, 'loginForm'])-> name('auth.loginForm');
Route::post('/login',[AuthController::class, 'login'])-> name('auth.login');

Route::middleware(['custom-auth'])->group(function(){
    Route::get('/profile',[ProfileController::class, 'index'])-> name('profile.index');
    Route::post('/logout',[AuthController::class, 'logout'])-> name('auth.logout');
});

Route::middleware(['maintenance-mode'])->group(function(){
    //using eloquent
    Route::get('/albums', [AlbumController::class, 'eloquent_index'])->name('album.eloquent.index');
    Route::post('/albums', [AlbumController::class, 'eloquent_store'])->name('album.eloquent.store');
    Route::get('/albums/{id}/edit', [AlbumController::class, 'eloquent_edit'])->name('album.eloquent.edit');
    Route::get('/albums/create', [AlbumController::class, 'eloquent_create'])->name('album.eloquent.create');
    Route::post('/albums/{id}', [AlbumController::class, 'eloquent_update'])->name('album.eloquent.update');

    // old albums
    Route::get('/albums_old', [AlbumController::class, 'index'])->name('album.index');
    Route::get('/albums_old/create', [AlbumController::class, 'create'])->name('album.create');
    Route::post('/albums_old', [AlbumController::class, 'store'])->name('album.store');
    Route::get('/albums_old/{id}/edit', [AlbumController::class, 'edit'])->name('album.edit');
    Route::post('/albums_old/{id}', [AlbumController::class, 'update'])->name('album.update');


    Route::get('/tracks', [TrackController::class, 'index'])->name('track.index');
    Route::get('/tracks/new', [TrackController::class, 'new'])->name('track.new');
    Route::post('/tracks', [TrackController::class, 'store'])->name('track.store');

    Route::get('/playlists', [PlaylistController::class, 'index'])->name('playlist.index');
    Route::get('/playlists/{id}', [PlaylistController::class, 'show'])->name('playlist.show');
    Route::get('/playlists/{id}/edit', [PlaylistController::class, 'edit'])->name('playlist.edit');
    Route::post('/playlists/{id}', [PlaylistController::class, 'update'])->name('playlist.update');

    Route::get('/register',[RegistrationController::class, 'index'])-> name('registration.index');
    Route::post('/register',[RegistrationController::class, 'register'])-> name('registration.create');
    
    Route::middleware(['custom-auth'])->group(function(){    
        Route::middleware(['admin-privilege'])->group(function(){
            Route::get('/admin',[AuthController::class, 'adminPage'])->name('admin');
            Route::post('/admin', [AuthController::class, 'maintenanceToggle'])->name('maintenanceToggle');
        });   
    }); 

});
