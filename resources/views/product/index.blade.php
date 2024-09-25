@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
<div class="search-container">
    <form class="search-form" method="GET" action="{{ route('product.search') }}">
        <div class="input-group">
            <input type="text" class="form-control" name="query" placeholder="{{ __('Search for products...') }}">
            <div class="input-group-append">
                <button class="btn btn-search" type="submit">{{ __('Search') }}</button>
            </div>
        </div>
    </form>
</div>
<div class="row">
    @foreach ($viewData["products"] as $product)
        <div class="col-md-4 col-lg-3 mb-2">
            <div class="card product-card">
                <img src="{{ asset('/storage/'.$product->getImage()) }}" class="card-img-top">
                <div class="card-body text-center">
                    <a href="{{ route('product.show', ['id'=> $product->getId()]) }}"
                       class="btn bg-primary text-white">{{ $product->getName() }}</a>
                </div>
                <div class="card-footer text-center">
                    <form id="add-to-cart-{{ $product->getId() }}" method="POST" action="{{ route('cart.add', ['id'=> $product->getId()]) }}">
                        @csrf
                        <button class="btn btn-primary btn-sm add-to-cart" data-product-id="{{ $product->getId() }}">
                            {{ __('Add to Cart') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.add-to-cart').click(function(e) {
        e.preventDefault();
        var productId = $(this).data('product-id');
        var form = $('#add-to-cart-' + productId);
        
        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: form.serialize(),
            success: function(response) {
                Swal.fire({
                    title: '{{ __("Success!") }}',
                    text: '{{ __("Product added to cart successfully") }}',
                    icon: 'success',
                    confirmButtonText: '{{ __("OK") }}'
                });
            },
            error: function() {
                Swal.fire({
                    title: '{{ __("Error!") }}',
                    text: '{{ __("Error adding product to cart") }}',
                    icon: 'error',
                    confirmButtonText: '{{ __("OK") }}'
                });
            }
        });
    });
});
</script>
@endsection