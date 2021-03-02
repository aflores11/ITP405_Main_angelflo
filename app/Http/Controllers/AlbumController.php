<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Album;
use App\Models\Artist;

class AlbumController extends Controller
{
    //Using Eloquent:

    public function eloquent_index(){

        $albums = Album::with('artist')
                        ->join('artists', 'artists.id', '=', 'albums.artist_id')
                        ->orderBy('artists.name')
                        ->orderBy('title')
                        ->get();

        return view('album.eloquent.index', [
            'albums' => $albums,
        ]);
    }

    public function eloquent_edit($id){

        $artists = Artist::orderBy('name')->get();
        $album = Album::find($id);

        return view('album.eloquent.edit', [
            'artists' => $artists,
            'album' => $album,
        ]);
    }

    public function eloquent_update($id, Request $request){
        $request->validate([
            'title' => 'required|max:50',
            'artist' => 'required|exists:artists,id'
        ]);

        $album = Album::where('id', '=', $id)->first();
        $album->title = $request->input('title');
        $album->artist_id = $request->input('artist');
        $album->save();
      
        return redirect()->route('album.eloquent.edit', ['id'=>$id])
        ->with('success', "Successfully updated {$request->input('title')}" );
    }

    public function eloquent_create(){

        $artists = Artist::orderBy('name')->get();

        return view('album.eloquent.create', [
            'artists' => $artists,
        ]);
    }

    public function eloquent_store(Request $request){
        $request->validate([
            'title' => 'required|max:20',
            'artist' => 'required|exists:artists,id'
        ]);

        $album = new Album();
        $album->title = $request->input('title');
        $album->artist_id = $request->input('artist');
        $album->save();
        
        return redirect()->route('album.eloquent.index')
        ->with('success', "Successfully created {$request->input('title')}" );
    }
    
    // ------------------------------------------------------
    // Using DB
    
    public function index(){

        $albums = DB::table('albums')
            ->join('artists', 'artists.id', '=' , 'albums.artist_id')
            ->orderBy('artist')
            ->orderBy('title')
            ->get([
                'albums.id',
                'albums.title',
                'artists.name AS artist',
            ]);


        return view('album.index', [
            'albums' => $albums,
        ]);
    }

    public function create(){

        $artists = DB::table('artists')->orderBy('name')->get();

        return view('album.create', [
            'artists' => $artists,
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required|max:20',
            'artist' => 'required|exists:artists,id'
        ]);

        DB::table('albums')->insert([
            'title' => $request->input('title'),
            'artist_id' => $request->input('artist')
        ]);
        
        return redirect()->route('album.index')
        ->with('success', "Successfully created {$request->input('title')}" );
    }

    public function edit($id){

        $artists = DB::table('artists')->orderBy('name')->get();
        $album = DB::table('albums')->where('id', '=', $id)->first();

        return view('album.edit', [
            'artists' => $artists,
            'album' => $album,
        ]);
    }

    public function update($id, Request $request){
        $request->validate([
            'title' => 'required|max:50',
            'artist' => 'required|exists:artists,id'
        ]);

        DB::table("albums")->where('id' , '=' , $id)->update([
            'title' => $request->input('title'),
            'artist_id' => $request->input('artist')
        ]);

        return redirect()->route('album.edit', ['id'=>$id])
        ->with('success', "Successfully updated {$request->input('title')}" );
    }
}
