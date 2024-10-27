@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="container">
    <h1>{{ $viewData['subtitle'] }}</h1>

    @if($viewData['playlist'])
        <h2>{{ $viewData['playlist']->getName() }}</h2>

        
        <iframe style="border-radius:12px" 
                src="https://open.spotify.com/embed/playlist/{{ $viewData['playlist']->getLink() }}" 
                width="100%" 
                height="352" 
                frameBorder="0" 
                allowfullscreen 
                allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" 
                loading="lazy">
        </iframe>

        <a href="{{ route('order.index') }}" class="btn btn-secondary mt-3">Back to Orders</a>
    @else
        <p>No playlist found.</p>
    @endif
</div>
@endsection
