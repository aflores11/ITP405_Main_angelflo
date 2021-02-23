<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlaylistController extends Controller
{
    public function index(){
        $playlists = DB::table('playlists')
        ->orderBy('id')
        ->get([
            'playlists.id',
            'playlists.name'
        ]); 
        
        return view('playlist.index', [
            'playlists' => $playlists
        ]);
    }

    public function show($id){
        $playlist = DB::table('playlists')
        ->where('id','=',$id)
        ->get([
            'playlists.name',
            'playlists.id'
        ])
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
    public function edit($id){

        $playlist = DB::table('playlists')->where('id', '=', $id)->first();

        return view('playlist.edit', [
            'playlist' => $playlist
        ]);
    }

    public function update($id, Request $request){
        $request->validate([
            'title' => 'required|max:30|unique:playlists,name',
        ]);

        DB::table("playlists")->where('id' , '=' , $id)->update([
            'name' => $request->input('title'),
        ]);

        return redirect()->route('playlist.index', ['id'=>$id])
        ->with('success', "{$request->input('oldName')} was successfully renamed to {$request->input('title')}" );
    }

}
