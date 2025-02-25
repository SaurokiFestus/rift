@extends('layouts.app')
@section('content')

<div class="container">
    <h2>Basket</h2>

    @if(session('success'))
        <div class="alert alert-success">{{session('success')}}</div>
    @endif

    @if($cartItems->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($cartItems as $item)
                    <tr>
                        <td><img src="{{ $item->product->image}}" width="50" alt=""></td>
                        <td>{{ $item->product->name}}</td>
                        <td>{{$item->product->price}}</td>
                        <td>
                            <!-- <form action="{{ route('cart.update', $item->product_id)}}" method="POST">
                                @csrf
                                <input type="number" name="quantity" value="{{$item->quantity}}" min="1">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form> -->
                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p>Your cart is empty</p>
    @endif
    <form action="{{ route('cart.checkout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success">Proceed to Checkout</button>
        </form>
</div>

@endsection