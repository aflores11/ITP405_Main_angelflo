@extends('layouts.main')

@section('title')
    Renaming {{ $playlist->name }}
@endsection

@section('content')
    <form action="{{ route('playlist.update', ['id' => $playlist->id]) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">New Title</label>
            <input  type="text" 
                    name="title" id="title" 
                    class="form-control" 
                    value="{{ old('title', $playlist->name) }}"
            >
            <input  type="hidden" 
                    name="oldName" id="oldName" 
                    value="{{ $playlist->name }}"
            >
            @error('title')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">
            Save
        </button>
    </form>
@endsection