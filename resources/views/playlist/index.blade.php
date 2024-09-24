@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
<div class="row">
    @foreach ($viewData["playlists"] as $playlist)
        <div class="col-md-4 col-lg-3 mb-2">
            <div class="card playlist-card">
                <img src="{{ asset('/storage/'.$playlist->getImageUrl()) }}" class="card-img-top">
                <div class="card-body text-center">
                    <a href="{{ route('playlist.show', ['id'=> $playlist->getId()]) }}"
                       class="btn bg-primary text-white">{{ $playlist->getName() }}</a>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ $playlist->getLink() }}" target="_blank" class="btn btn-secondary btn-sm">
                        Ver en Spotify
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
