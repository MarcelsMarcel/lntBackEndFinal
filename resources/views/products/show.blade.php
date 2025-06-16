@extends('templateUser')
@section('content-name', 'Book Details')
@section('content')

<div class="card" style="width: 24rem;">
    <img src="{{ Storage::url($product->image) }}" class="card-img-top" alt="{{ $product->name }}">
    <div class="card-body">
        <h5 class="card-title">{{ $product->name }}</h5>
        <p class="card-text"><strong>Author:</strong> {{ $product->author }}</p>
        <p class="card-text"><strong>Publisher:</strong> {{ $product->publisher }}</p>
        <p class="card-text"><strong>Page:</strong> {{ $product->page }}</p>
        <p class="card-text"><strong>Price:</strong> Rp{{ $product->price }}</p>

        <!-- Add to Cart -->
        <form method="POST" action="{{ route('cart.add', $product->id) }}" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-warning">Add to Cart</button>
        </form>

        <!-- Buy -->
        <form method="POST" action="{{ route('product.buy', $product->id) }}" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-success">Buy Now</button>
        </form>

        <br><br>
        <a href="{{ route('user.home') }}" class="btn btn-secondary">Back to Home</a>
    </div>
</div>

@endsection
