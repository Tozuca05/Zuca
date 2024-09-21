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
                                <i class="bi bi-arrow-left"></i> Back to Products<img src="{{ asset('storage/'.$viewData['product']->getImage()) }}" class="img-fluid rounded-start" alt="{{ $viewData['product']->getName() }}">
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection