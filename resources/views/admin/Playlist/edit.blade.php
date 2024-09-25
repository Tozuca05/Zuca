@extends('layouts.admin')
@section('title', $viewData["title"])
@section('content')
<div class="card mb-4">
    <div class="card-header">
        Edit Playlist
    </div>
    <div class="card-body">
        @if($errors->any())
        <ul class="alert alert-danger list-unstyled">
            @foreach($errors->all() as $error)
            <li>- {{ $error }}</li>
            @endforeach
        </ul>
        @endif

        <form method="POST" action="{{ route('admin.playlist.update', ['id'=> $viewData['playlist']->getId()]) }}">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col">
                    <div class="mb-3 row">
                        <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Name:</label>
                        <div class="col-lg-10 col-md-6 col-sm-12">
                            <input name="name" value="{{ $viewData['playlist']->getName() }}" type="text" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="mb-3 row">
                        <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Link:</label>
                        <div class="col-lg-10 col-md-6 col-sm-12">
                            <input name="link" value="{{ $viewData['playlist']->getLink() }}" type="url" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="mb-3 row">
                        <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Image URL:</label>
                        <div class="col-lg-10 col-md-6 col-sm-12">
                            <input name="image_url" value="{{ $viewData['playlist']->getImageUrl() }}" type="url" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="mb-3 row">
                        <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Tag:</label>
                        <div class="col-lg-10 col-md-6 col-sm-12">
                            <select name="tag_id" class="form-select">
                                @foreach ($viewData["tags"] as $tag)
                                <option value="{{ $tag->getId() }}" {{ $viewData['playlist']->getTagId() == $tag->getId() ? 'selected' : '' }}>
                                    {{ $tag->getName() }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Edit</button>
        </form>
    </div>
</div>
@endsection