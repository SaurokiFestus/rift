@extends('layouts.app')
@section('content')


<div class="card m-3 m-sm-2 m-md-2">
  <div class="card-header">
    Products
  </div>
  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-2 m-3 m-sm-2 m-md-2">
    @foreach($products as $product)
    <div class="col">
      <div class="card">
        <img src="{{ asset ('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
        <div class="card-body">
          <h5 class="card-title">{{ $product->name }}</h5>
          <p class="card-text">{{ $product->description }}</p>
          <p class="card-text">Price: ${{ $product->price }}</p>
          <p class="card-text">Remaining pieces: {{ $product->quantity }}</p>
          <form action="{{ route('cart.add', $product->id)}}" method="POST">
            @csrf
            <input type="number" name="quantity" value="1" min="1">
            <button type="submit" class="btn btn-success">Add to Basket</button>
          </form>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
  @endsection