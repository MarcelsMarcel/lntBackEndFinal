@extends('template')
@section('content-name','Login')
@section('content')
<form action="{{route('login-user')}}" method="post">
    @csrf
    @method('POST')
  <div class="mb-3">
    <label for="name" class="form-label">Username</label>
    <input type="string" class="form-control" id="name" name="name" value="{{ old(
    'name') }}">
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
<a href="{{ route('register') }}">Register Here!</a>
<a href="{{ route('guest.home') }}">Continue as Guest</a>



@endsection

