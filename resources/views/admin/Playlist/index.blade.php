@extends('layouts.admin')
@section('title', $viewData["title"])
@section('content')
<div class="card mb-4">
    <div class="card-header">
        Create Playlist
    </div>
    <div class="card-body">
        @if($errors->any())
        <ul class="alert alert-danger list-unstyled">
            @foreach($errors->all() as $error)
            <li>- {{ $error }}</li>
            @endforeach
        </ul>
        @endif

        <form method="POST" action="{{ route('admin.playlist.store') }}">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Name:</label>
                        <input name="name" value="{{ old('name') }}" type="text" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Link:</label>
                        <input name="link" value="{{ old('link') }}" type="text" class="form-control" required> <!-- Cambiado a type="text" -->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Tag:</label>
                        <select name="tag_id" class="form-select" required>
                            <option value="">Select a tag</option>
                            @foreach ($viewData["tags"] as $tag)
                            <option value="{{ $tag->getId() }}">{{ $tag->getName() }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        Manage Playlists
    </div>
    <div class="card-body">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Link</th>
                    <th>Tag</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($viewData["playlists"] as $playlist)
                <tr>
                    <td>{{ $playlist->getId() }}</td>
                    <td>{{ $playlist->getName() }}</td>
                    <td><a href="{{ $playlist->getLink() }}" target="_blank">{{ $playlist->getLink() }}</a></td>
                    <td>{{ $playlist->getTag() ? $playlist->getTag()->getName() : 'No Tag' }}</td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('admin.playlist.edit', ['id'=> $playlist->getId()]) }}">
                            <i class="bi-pencil"></i>
                        </a>
                    </td>
                    <td>
                        <form action="{{ route('admin.playlist.delete', $playlist->getId())}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">
                                <i class="bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
