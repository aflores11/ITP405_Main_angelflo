@extends('layouts.main')

@section('title','Albums (Eloquent)')

@section('content')
    @can('create', App\Models\Album::class)
        <div class="text-end mb-3">
            <a href="{{ route('album.eloquent.create') }}">New Album</a>
        </div>
    @endcan
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Album</th>
                <th>Artist</th>
                <th>Created By</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody>
            @foreach($albums as $album)
                <tr>
                    <td>
                        {{ $album->title}}
                    </td>
                    <td>
                        {{ $album->artist->name}}
                    </td>
                    <td>
                        {{  $album->user->name }}
                    </td>
                    <td>
                        @can('edit', $album)
                            <a href="{{ route('album.eloquent.edit', ['id' => $album->getID()]) }}">Edit</a>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection