@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Review Your Order</h1>
        <div class="order-summary">
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalAmount = 0;
                    @endphp
                    @foreach ($cart as $item)
                        @php
                            $totalAmount += $item['price'] * $item['quantity'];
                        @endphp
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>{{ number_format($item['price'], 2) }} KZT</td>
                            <td>{{ number_format($item['price'] * $item['quantity'], 2) }} KZT</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3" class="text-right"><strong>Total</strong></td>
                        <td><strong>{{ number_format($totalAmount, 2) }} KZT</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <form action="{{ route('order.store') }}" method="POST">
            @csrf
            <input type="hidden" name="cart" value="{{ json_encode($cart) }}">
            <input type="hidden" name="totalAmount" value="{{ $totalAmount }}">
            <input type="hidden" name="paymentMethod" value="{{ request('payment_method', 'cash') }}">

            <button type="submit" class="btn btn-primary">Place Order</button>
        </form>
    </div>
@endsection
