@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
<div class="row">
    @foreach ($viewData["products"] as $product)
        <div class="col-md-4 col-lg-3 mb-2">
            <div class="card">
                <img src="{{ asset('/storage/'.$product->getImage()) }}" class="card-img-top img-card">
                <div class="card-body text-center">
                    <a href="{{ route('product.show', ['id'=> $product->getId()]) }}"
                       class="btn bg-primary text-white">{{ $product->getName() }}</a>
                </div>
                <div class="card-footer text-center">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>${{ $product->getPrice() }}</span>
                        <form method="POST" action="{{ route('cart.add', ['id'=> $product->getId()]) }}">
                            @csrf
                            <button class="btn btn-primary btn-sm">
                                Add to Cart
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection