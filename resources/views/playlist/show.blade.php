@extends('layouts.main')

@if(!is_null($playlist))
    @section('title')
        Playlist: {{$playlist->name}}  
    @endsection

    @section('content')
        
        @if(!$playlistDetails->isEmpty())
            <a href="{{route('playlist.index')}}" class="d-block mb-3">Back to Playlists</a>
            <p>Total Tracks: {{$playlistDetails->count()}}</p>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Track</th>
                        <th>Album</th>
                        <th>Artist</th>
                        <th>Price</th>
                        <th>Genre</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($playlistDetails as $pD)
                        <tr>
                            <td>{{$pD->track}}</td>
                            <td>{{$pD->album}}</td>
                            <td>{{$pD->artist}}</td>
                            <td>${{$pD->unit_price}}</td>
                            <td>{{$pD->genre}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            No tracks found for Playlist {{$playlist->id}} 
        @endif 
        
    @endsection
@else
    @section('title')
        Playlist Does Not Exist.   
    @endsection
@endif