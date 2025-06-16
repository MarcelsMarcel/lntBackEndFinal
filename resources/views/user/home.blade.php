@extends('templateUser')
@section('content-name','Home Page')
@section('content')
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Book Name</th>
      <th scope="col">Author</th>
      <th scope="col">Publisher</th>
      <th scope="col">Page</th>
      <th scope="col">Price</th>
      <th scope="col">Image</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
    @forelse ($products as $product)
    <th scope="row">{{$product->id}}</th>
    <td>{{$product->name}}</td>
    <td>{{$product->author}}</td>
    <td>{{$product->publisher}}</td>
    <td>{{$product->page}}</td>
    <td>{{$product->price}}</td>
    <td>
        <img src="{{ Storage::url($product->image) }}" alt="" style="width: 80px; height:80px">
    </td>
    <td>
    <a href="{{ route('product.show', $product) }}" class="btn btn-info">View</a>
    </td>


    </tr>
    @empty
        <h1>
            No Product Found
        </h1>
    @endforelse
  </tbody>
</table>
@endsection
