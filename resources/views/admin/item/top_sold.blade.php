@extends('layouts.admin')

@section('title', $viewData['title'])

@section('content')
<div class="card mb-4">
    <div class="card-header">
        Productos Más Vendidos
    </div>
    <div class="card-body">
        @if($viewData['topProducts']->isEmpty())
            <p>No hay datos de ventas disponibles.</p>
        @else
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad Vendida</th>
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
