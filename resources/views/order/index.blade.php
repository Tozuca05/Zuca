@extends('layouts.app')
@section('title', 'My Orders')
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
                            @foreach ($order->items as $item)
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
                        <form method="POST" action="{{ route('order.pay', ['id' => $order->getId()]) }}">
                            @csrf
                            <button type="submit" class="btn btn-success">Pay</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="col-12">
            <p class="text-center">You have no orders pending payment.</p>
        </div>
    @endif
</div>
@endsection
