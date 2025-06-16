@extends('templateUser')
@section('content-name', 'Your Cart')
@section('content')


@if (empty($cart))
    <p>Your cart is empty.</p>
@else
    <table class="table">
        <thead>
            <tr>
                <th>Book</th>
                <th>Image</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach ($cart as $id => $item)
                @php $subtotal = $item['price'] * $item['quantity']; $total += $subtotal; @endphp
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td><img src="{{ Storage::url($item['image']) }}" style="width: 60px; height: 60px;"></td>
                    <td>Rp{{ $item['price'] }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>Rp{{ $subtotal }}</td>
                    <td>
                        <form action="{{ route('cart.remove', $id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mb-3">
        <strong>Total: Rp{{ $total }}</strong>
    </div>

    <form action="{{ route('cart.checkout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-success">Checkout</button>
    </form>
@endif

@endsection
