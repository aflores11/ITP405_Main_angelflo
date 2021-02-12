<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlaylistController extends Controller
{
    public function index(){
        $playlists = DB::table('playlists')
        ->get([
            'playlists.id',
            'playlists.name'
        ]); 
        
        return view('playlist.index', [
            'playlists' => $playlists
        ]);
    }

    public function show($id){
        $playlist = DB::table('playlist')
        ->where('id','=',$id)
        ->first();

        $playlistDetails = DB::table('playlists')
        ->where('playlist_id', '=', $id)
        ->join('playlist_track', 'playlists.id', '=', 'playlist_track.playlist_id') 
        ->join('tracks', 'playlist_track.track_id', '=', 'tracks.id') 
        ->join('albums', 'tracks.album_id', '=', 'albums.id') 
        ->join('genres', 'tracks.genre_id', '=', 'genres.id') 
        ->join('artists', 'albums.artist_id', '=', 'artists.id') 
        ->get([
            'tracks.name AS track',
            'albums.title AS album',
            'artists.name AS artist',
            'tracks.unit_price',
            'genres.name AS genre'
        ]); 

        return view('playlist.show',[
            'playlist'=>$playlist,
            'playlistDetails' => $playlistDetails
        ]);
    }
}
