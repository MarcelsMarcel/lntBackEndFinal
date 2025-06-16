@extends('template')
@section('content-name','Home Page')
@section('content')
<a href="{{route('product.create')}}"class="btn btn-success">Add Book</a>
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
        <form action="{{ route('product.destroy', $product) }}" method="POST" style="display: inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
        <a href="{{ route('product.edit', $product) }}"class="btn btn-primary">Edit</a>
        <a href="{{ route('product.show', $product->id) }}" class="btn btn-info btn-sm">View Details</a>
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
