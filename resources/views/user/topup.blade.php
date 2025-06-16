@extends('templateUser')
@section('content-name', 'Top Up Balance')
@section('content')
@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<form method="POST" action="{{ route('user.topup.process') }}">
    @csrf
    <div class="mb-3">
        <label for="amount" class="form-label">Amount</label>
        <input type="number" name="amount" id="amount" class="form-control" required min="1">
    </div>
    <button type="submit" class="btn btn-primary">Top Up</button>
</form>
@endsection
