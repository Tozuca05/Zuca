@extends('layouts.admin')

@section('title', $viewData["title"])

@section('content')
<div class="card mb-4">
    <div class="card-header">
        {{ isset($viewData['playlist']) ? 'Edit Playlist' : 'Create Playlist' }}
    </div>
    <div class="card-body">
        @if($errors->any())
        <ul class="alert alert-danger list-unstyled">
            @foreach($errors->all() as $error)
            <li>- {{ $error }}</li>
            @endforeach
        </ul>
        @endif

        <form method="POST" action="{{ isset($viewData['playlist']) ? route('admin.playlist.update', ['id'=> $viewData['playlist']->getId()]) : route('admin.playlist.store') }}">
            @csrf
            @if(isset($viewData['playlist']))
                @method('PUT')
            @endif
            
            <div class="row">
                <div class="col">
                    <div class="mb-3 row">
                        <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Name:</label>
                        <div class="col-lg-10 col-md-6 col-sm-12">
                            <input name="name" value="{{ isset($viewData['playlist']) ? $viewData['playlist']->getName() : '' }}" type="text" class="form-control" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="mb-3 row">
                        <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Link:</label>
                        <div class="col-lg-10 col-md-6 col-sm-12">
                            <input name="link" value="{{ isset($viewData['playlist']) ? $viewData['playlist']->getLink() : '' }}" type="text" class="form-control" required> <!-- Cambiado a type="text" -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="mb-3 row">
                        <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Tag:</label>
                        <div class="col-lg-10 col-md-6 col-sm-12">
                            <select name="tag_id" class="form-select" required>
                                @foreach ($viewData["tags"] as $tag)
                                <option value="{{ $tag->getId() }}" {{ isset($viewData['playlist']) && $viewData['playlist']->getTagId() == $tag->getId() ? 'selected' : '' }}>
                                    {{ $tag->getName() }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">{{ isset($viewData['playlist']) ? 'Update' : 'Create' }}</button>
        </form>
    </div>
</div>
@endsection
