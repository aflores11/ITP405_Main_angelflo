<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrackController extends Controller
{
    public function index(){
        $tracks = DB::table('tracks')
        ->join('albums', 'albums.id', '=' , 'tracks.album_id')
        ->join('artists', 'artists.id', '=' , 'albums.artist_id')
        ->join('media_types', 'media_types.id', '=' , 'tracks.media_type_id')
        ->join('genres', 'genres.id', '=' , 'tracks.genre_id')
        ->orderBy('album')
        ->orderBy('name')
        ->get([
                        'tracks.id',
                        'tracks.name',
                        'albums.title as album',
                        'artists.name AS artist',
                        'media_types.name as media',
                        'genres.name as genre',
                        'tracks.unit_price as price' 
                    ]);
        
    return view('track.index', [
                'tracks' => $tracks,
                ]);
    }

    public function new(){

        $albums = DB::table('albums')->orderBy('title')->get();
        $medium = DB::table('media_types')->orderBy('name')->get();
        $genres = DB::table('genres')->orderBy('name')->get();

        return view('track.new', [
            'medium' => $medium,
            'albums' => $albums,
            'genres' => $genres
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required|max:30',
            'album' => 'required|exists:albums,id',
            'genre' => 'required|exists:genres,id',
            'media_type' => 'required|exists:media_types,id',
            'unit_price' => 'required|numeric'
        ]);
        
        DB::table('tracks')->insert([
            'name' => $request->input('title'),
            'album_id' => $request->input('album'),
            'media_type_id' => $request->input('media_type'),
            'genre_id' => $request->input('genre'),
            'unit_price' => $request->input('unit_price'),
        ]);

        
        return redirect()->route('track.index')
        ->with('success', "The track {$request->input('title')} was successfully created!" );
    }
}
