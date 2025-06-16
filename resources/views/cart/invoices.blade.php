@extends('templateUser')
@section('content-name', 'My Invoices')
@section('content')

<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Book</th>
            <th>Quantity</th>
            <th>Total Price</th>
            <th>Purchased At</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($invoices as $invoice)
        <tr>
            <td>{{ $invoice->id }}</td>
            <td>{{ $invoice->product->name }}</td>
            <td>{{ $invoice->quantity }}</td>
            <td>Rp{{ $invoice->total_price }}</td>
            <td>{{ $invoice->created_at->format('d M Y H:i') }}</td>
        </tr>
        @empty
        <tr><td colspan="5" class="text-center">No purchases yet.</td></tr>
        @endforelse
    </tbody>
</table>

@endsection
