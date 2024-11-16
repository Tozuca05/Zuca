@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
<div class="container mt-4">
    <div class="row">
        @if(count($viewData['orders']) > 0)
            @foreach ($viewData['orders'] as $order)
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span><strong>Order ID:</strong> {{ $order->getId() }}</span>
                            <span class="text-muted">{{ $order->getCreatedAt() }}</span>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Order Summary</h5>
                            <ul class="list-group list-group-flush">
                                @foreach ($order->getItems() as $item)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{ $item->getProduct()->getName() }} 
                                        <span>(x{{ $item->getQuantity() }}): ${{ number_format($item->getPrice() * $item->getQuantity(), 2) }}</span>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="mt-3 text-end">
                                <strong>Total:</strong> ${{ number_format($order->getTotal(), 2) }}
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            @if($order->getStatus() == "Pending")
                                <form method="POST" action="{{ route('order.pay', ['id' => $order->getId()]) }}" class="d-inline-block">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Pay</button>
                                </form>
                            @else
                                <p class="text-success mb-0"><strong>Status:</strong> Paid</p>
                            @endif
                            @php
                                $playlistToShow = $order->getAssociatedPlaylist();
                            @endphp
                            @if($playlistToShow) 
                                <a href="{{ route('playlists.show', ['id' => $playlistToShow->getId()]) }}" class="btn btn-primary mt-2" target="_blank">
                                    Check Playlist
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <p>You have no orders.</p>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
