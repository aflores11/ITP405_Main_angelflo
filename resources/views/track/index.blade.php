@extends('layouts.main')

@section('title','Tracks')

@section('content')
    <div class="text-end mb-3">
        <a href="{{ route('track.new') }}">New Track</a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Album</th>
                <th>Artist</th>
                <th>Media</th>
                <th>Genre</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tracks as $t)
                <tr>
                    <td>
                        {{$t->name}}
                    </td>
                    <td>
                        {{$t->album}}
                    </td>
                    <td>
                        {{$t->artist}}
                    </td>
                    <td>
                        {{$t->media}}
                    </td>
                    <td>
                        {{$t->genre}}
                    </td>
                    <td>
                        {{$t->price}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection