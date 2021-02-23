@extends('layouts.main')

@section('title', 'New Track')

@section('content')
    <form action="{{ route('track.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
            @error('title')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="album" class="form-label">Album</label>
            <select name="album" 
                    id="album" 
                    class="form-select"
                    >
                <option value="">-- Select Album --</option>
                @foreach($albums as $album)
                    <option 
                    value="{{$album->id}}"
                    {{ (string) $album->id === old('album') ? "selected" : "" }}
                    >
                        {{$album->title}}
                    </option>
                @endforeach
            </select>
            @error('album')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="media_type" class="form-label">Media Type</label>
            <select name="media_type" 
                    id="media_type" 
                    class="form-select"
                    >
                <option value="">-- Select Media Type --</option>
                @foreach($medium as $media)
                    <option 
                    value="{{$media->id}}"
                    {{ (string) $media->id === old('media_type') ? "selected" : "" }}
                    >
                        {{$media->name}}
                    </option>
                @endforeach
            </select>
            @error('media_type')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="genre" class="form-label">Genre</label>
            <select name="genre" 
                    id="genre" 
                    class="form-select"
                    >
                <option value="">-- Select Genre --</option>
                @foreach($genres as $genre)
                    <option 
                    value="{{$genre->id}}"
                    {{ (string) $genre->id === old('genre') ? "selected" : "" }}
                    >
                        {{$genre->name}}
                    </option>
                @endforeach
            </select>
            @error('genre')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label for="unit_price" class="form-label">Price</label>
            <input type="text" name="unit_price" id="unit_price" class="form-control" value="{{ old('unit_price') }}">
            @error('unit_price')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">
            Save
        </button>
    </form>
@endsection