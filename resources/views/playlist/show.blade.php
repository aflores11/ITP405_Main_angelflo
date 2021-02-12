@extends('layouts.main')

@section('title')
    Playlist #{{$playlist->id}}       
@endsection

@section('content')
    <a href="{{route('playlist.index')}}" class="d-block mb-3">Back to Playlists</a>
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
@endsection