@extends('template')
@section('content-name', 'Book Detail')
@section('content')

<div class="card">
    <div class="card-header">
        <h3>{{ $product->name }}</h3>
    </div>
    <div class="card-body">
        <img src="{{ Storage::url($product->image) }}" style="width: 200px; height: 200px;">
        <p><strong>Author:</strong> {{ $product->author }}</p>
        <p><strong>Publisher:</strong> {{ $product->publisher }}</p>
        <p><strong>Pages:</strong> {{ $product->page }}</p>
        <p><strong>Price:</strong> Rp{{ $product->price }}</p>
    </div>
</div>

@endsection
