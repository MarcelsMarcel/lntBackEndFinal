@extends('templateGuest')
@section('content-name','Welcome Guest!')
@section('content')
<table class="table">
  <thead>
    <tr>
      <th>#</th>
      <th>Book Name</th>
      <th>Author</th>
      <th>Publisher</th>
      <th>Page</th>
      <th>Price</th>
      <th>Image</th>
    </tr>
  </thead>
  <tbody>
    @forelse ($products as $product)
    <tr>
      <th scope="row">{{ $product->id }}</th>
      <td>{{ $product->name }}</td>
      <td>{{ $product->author }}</td>
      <td>{{ $product->publisher }}</td>
      <td>{{ $product->page }}</td>
      <td>Rp{{ $product->price }}</td>
      <td>
        <img src="{{ Storage::url($product->image) }}" alt="" style="width: 80px; height:80px">
      </td>
    </tr>
    @empty
    <tr>
      <td colspan="7" class="text-center">No products found</td>
    </tr>
    @endforelse
  </tbody>
</table>
<p class="mt-3">Want to buy books? <a href="{{ route('login') }}">Login here</a></p>
@endsection
