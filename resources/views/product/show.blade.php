@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
    <div class="card mb-3 shadow-sm">
        <div class="row g-0">
            <div class="col-md-4">
            <img src="{{ asset('storage/'.$viewData['product']->getImage()) }}" class="img-fluid rounded-start" alt="{{ $viewData['product']->getName() }}">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h3 class="card-title">
                        {{ $viewData["product"]->getName() }}
                        <span class="text-muted">(${{ number_format($viewData["product"]->getPrice(), 2) }})</span>
                    </h3>
                    <p class="card-text mt-3">{{ $viewData["product"]->getDescription() }}</p>
                    <div class="mb-3">
                        <p class="card-text">
                            <small class="text-muted">
                                Created at: {{ $viewData["product"]->created_at->format('Y-m-d H:i') }}
                            </small><br>
                            <small class="text-muted">
                                Updated at: {{ $viewData["product"]->updated_at->format('Y-m-d H:i') }}
                            </small>
                        </p>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <form method="POST" action="{{ route('admin.product.delete', ['id'=> $viewData['product']->getId()]) }}">
                            @csrf
                            @if (Auth::user()->getRole() === 'admin')
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash"></i> Delete Product
                            </button>
                            @endif
                            <a href="{{ route('product.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Back to Products
                            </a>
                        </form>
                        <form id="add-to-cart-{{ $viewData['product']->getId() }}" method="POST" action="{{ route('cart.add', ['id'=> $viewData['product']->getId()]) }}">
                            @csrf
                            <button type="submit" class="btn btn-success add-to-cart" data-product-id="{{ $viewData['product']->getId() }}">
                                <i class="bi bi-cart-plus"></i> Add to Cart
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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