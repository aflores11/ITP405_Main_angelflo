@extends('layouts.main')

@section('title','Playlists')

@section('content')
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Playlist</th>
            </tr>
        </thead>
        <tbody>
            @foreach($playlists as $playlist)
                <tr>
                    <td>
                        {{$playlist->id}}
                    </td>
                    <td>
                        {{$playlist->name}}
                    </td>
                    <td>
                        <a href="{{route('playlist.show', ['id' => $playlist->id])}}">
                            Details
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection