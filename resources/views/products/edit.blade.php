@extends('template')
@section('content-name','Edit Product')
@section('content')
<h1>Edit Product</h1>
<form action="{{route('product.update', $product)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
  <div class="mb-3">
    <label for="bookName" class="form-label">Book Name</label>
    <input type="text" class="form-control" id="bookName" name="name" value="{{ $product->name }}">
    @error('name')
        <div class="alert alert-danger" role="alert">
        {{$message}}
        </div>
    @enderror
  </div>
  <div class="mb-3">
    <label for="author" class="form-label">Author</label>
    <input type="text" class="form-control" id="author" name="author" value="{{ $product->author }}">
        @error('author')
        <div class="alert alert-danger" role="alert">
        {{$message}}
        </div>
    @enderror
  </div>
  <div class="mb-3">
    <label for="publisher" class="form-label">Publisher</label>
    <input type="text" class="form-control" id="publisher" name="publisher" value="{{ $product->publisher }}">
    @error('publisher')
        <div class="alert alert-danger" role="alert">
        {{$message}}
        </div>
    @enderror
  </div>

  <div class="mb-3">
    <label for="page" class="form-label">Number of Page</label>
    <input type="number" class="form-control" id="page" name="page" value="{{ $product->page}}">
        @error('page')
        <div class="alert alert-danger" role="alert">
        {{$message}}
        </div>
    @enderror
  </div>
  <div class="mb-3">
    <label for="bookPrice" class="form-label">Price</label>
    <input type="number" class="form-control" id="bookPrice" name="price" value="{{ $product->price}}">
        @error('price')
        <div class="alert alert-danger" role="alert">
        {{$message}}
        </div>
    @enderror
  </div>
  <div class="mb-3">
    <label for="bookImage" class="form-label">Book Image</label>
    <input type="file" class="form-control" id="bookImage" name="image">
        @error('image')
        <div class="alert alert-danger" role="alert">
        {{$message}}
        </div>
    @enderror
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>


@endsection
