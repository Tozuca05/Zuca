@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
<div class="row">
    @if(count($viewData['orders']) > 0)
        @foreach ($viewData['orders'] as $order)
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <span>Order ID: {{ $order->getId() }}</span>
                        <span>{{ $order->getCreatedAt() }}</span>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Order Summary</h5>
                        <ul class="list-group list-group-flush">
                            @foreach ($order->getItems() as $item)
                                <li class="list-group-item">
                                    {{ $item->getProduct()->getName() }} 
                                    (x{{ $item->getQuantity() }}): ${{ $item->getPrice() * $item->getQuantity() }}
                                </li>
                            @endforeach
                        </ul>
                        <div class="mt-3">
                            <strong>Total: ${{ $order->getTotal() }}</strong>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        @if($order->getStatus() == "Pending")
                            <form method="POST" action="{{ route('order.pay', ['id' => $order->getId()]) }}">
                                @csrf
                                <button type="submit" class="btn btn-success">Pay</button>
                            </form>
                        @else
                            <p class="text-success mb-2">Order is paid</p>
                        @endif
                        
                        @php
                            $playlistToShow = $order->getAssociatedPlaylist();
                        @endphp

                        @if($playlistToShow)
                            <a href="{{ route('playlists.show', ['id' => $playlistToShow->getId()]) }}" class="btn btn-primary" target="_blank">
                                Check your playlist
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="col-12">
            <p class="text-center">You have no orders.</p>
        </div>
    @endif
</div>
@endsection
