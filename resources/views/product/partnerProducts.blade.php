@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
<div class="row">
    @foreach ($viewData["partnerProducts"] as $product)
        <div class="col-md-4 col-lg-3 mb-2">
            <div class="card product-card">
                <div class="card-footer text-center">
                    <strong>{{ $product['name'] }}</strong>
                </div>
                <img src="{{ $product['image'] }}" class="card-img-top" alt="{{ $product['name'] }}">
                <div class="card-body text-center">
                    <a href="{{ $product['link'] }}" class="btn btn-primary" target="_blank">View Product</a>
                </div>
                <div class="card-footer text-center">
                    <strong>Price: ${{ number_format($product['price'], 2) }}</strong>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection

@section('scripts')
<!-- Include any scripts if necessary -->
@endsection
