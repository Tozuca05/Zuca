@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="container">
    <h1>{{ $viewData['subtitle'] }}</h1>

    @if($viewData['playlist'])
        <h2>Associated Playlist</h2>
        <h3>{{ $viewData['playlist']->getName() }}</h3>
        <iframe style="border-radius:12px" 
                src="https://open.spotify.com/embed/playlist/{{ $viewData['playlist']->getLink() }}" 
                width="100%" 
                height="352" 
                frameBorder="0" 
                allowfullscreen 
                allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" 
                loading="lazy">
        </iframe>
    @else
        <p>No associated playlist for this order.</p>
    @endif
</div>
@endsection
