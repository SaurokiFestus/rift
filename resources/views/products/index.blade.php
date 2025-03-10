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
          <!-- <p class="card-text">Remaining pieces: {{ $product->quantity }}</p> -->
          <form class="add-to-basket" data-id="{{ $product->id}}">
            @csrf
            <!-- <input type="number" name="quantity" min="1"> -->
            <!-- <input type="number" name="quantity" min="1" value="1" style="width: 60px;"> -->
            <button type="submit" class="btn btn-success">Add to Basket</button>
          </form>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    $('.add-to-basket').on('submit', function(e) {
      e.preventDefault();
      var form = $(this);
      var productId = form.data('id');
      var quantity = form.find('input[name="quantity"]').val();
      var quantity = 1;
      $.ajax({
        url: '{{ route("cart.add", ":id") }}' .replace(':id', productId),
        method: 'POST',
        data: {
          _token: '{{ csrf_token() }}',
          quantity: quantity
        },
        success: function(response) {
          if (response.success) {
           var currentCount = parseInt($('#cart-count').text());
            $('#cart-count').text(currentCount + 1);
          } else {
            alert('Failed to add product to cart!');
          }
        },
        error: function(xhr) {
          console.log(xhr.responseText);
        }
      });
    });
  });
</script>
@endsection