@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
<div class="row">
    @foreach ($viewData["playlists"] as $playlist)
        <div class="col-md-4 col-lg-3 mb-2">
            <div class="card playlist-card">
                <a href="{{ $playlist->getLink() }}" target="_blank">
                    <img src="{{ asset('/storage/'.$playlist->getImageUrl()) }}" class="card-img-top" alt="{{ $playlist->getName() }}">
                </a>
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $playlist->getName() }}</h5>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
