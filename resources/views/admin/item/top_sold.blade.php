@extends('layouts.admin')
@section('title', $viewData['title'])

@section('content')
<div class="card mb-4">
    <div class="card-header">
        Top Selling Products
    </div>
    <div class="card-body">
        @if($viewData['topProducts']->isEmpty())
            <p>No sales data available.</p>
        @else
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity Sold</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($viewData['topProducts'] as $item)
                        <tr>
                            <td>{{ $item->getProduct()->getName() }}</td>
                            <td>{{ $item->getTotalSold() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
