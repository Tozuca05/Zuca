@extends('layouts.app')

@section('title', $viewData["title"])

@section('content')
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach($products as $index => $product)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                <img src="{{ asset('/storage/'.$product->getImage()) }}" class="d-block w-100" alt="{{ $product->getName() }}">

                    <div class="carousel-caption d-none d-md-block">
                        <h5>{{ $product->getName() }}</h5>
                        <p>${{ $product->getPrice() }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
