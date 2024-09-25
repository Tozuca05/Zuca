@extends('layouts.app') 
@section('title', $viewData["title"]) 
@section('subtitle', $viewData["subtitle"]) 
@section('content') 
<div class="card"> 
  <div class="card-header"> 
    Products in Cart 
  </div> 
  <div class="card-body"> 
    <table class="table table-bordered table-striped text-center"> 
      <thead> 
        <tr> 
          <th scope="col">ID</th> 
          <th scope="col">Name</th> 
          <th scope="col">Price</th> 
          <th scope="col">Quantity</th> 
          <th scope="col">Actions</th>
        </tr> 
      </thead> 

      <tbody> 
        @foreach ($viewData["products"] as $product) 
        <tr> 
          <td>{{ $product->getId() }}</td> 
          <td>{{ $product->getName() }}</td> 
          <td>${{ $product->getPrice() }}</td> 
          <td>
          <form action="{{ route('cart.subtract', ['id' => $product->getId()]) }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn btn-sm btn-secondary">-</button>
          </form>
          {{ session('products')[$product->getId()] }}
          <form action="{{ route('cart.add', ['id' => $product->getId()]) }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn btn-sm btn-secondary">+</button>
          </form>
          </td>
          <td>
            <a href="{{ route('cart.remove', ['id' => $product->getId()]) }}" class="btn btn-danger">
              Remove
            </a>
          </td>
        </tr> 
        @endforeach 
      </tbody> 
    </table> 
    <div class="row"> 
      <div class="text-end"> 
        <a class="btn btn-outline-secondary mb-2"><b>Total to pay:</b> ${{ $viewData["total"] }}</a> 
        <a href="{{ route('order.create') }}" class="btn bg-primary text-white mb-2">Purchase</a> 
        <a href="{{ route('cart.delete') }}"> 
          <button class="btn btn-danger mb-2"> 
            Remove all products from Cart 
          </button> 
        </a>  

      </div> 
    </div> 
  </div> 
</div> 
@endsection