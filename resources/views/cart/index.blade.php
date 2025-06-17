@extends('layouts.app')

@section('content')
<div class="cart-container">
    <h1>Your Shopping Cart</h1>

    @if (count($cartItems) === 0)
        <p>Your cart is empty.</p>
    @else
        <table class="cart-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cartItems as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>${{ number_format($item->product->price, 2) }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>${{ number_format($item->product->price * $item->quantity, 2) }}</td>
                        <td>
                            <form method="POST" action="{{ route('cart.remove', $item->product_id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="remove-btn">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="cart-total">
            <h3>Total: ${{ number_format($total, 2) }}</h3>
        </div>
        <form action="{{ route('checkout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Order</button>
        </form>
    @endif
</div>
<div class="logo">
    <a href="{{ route('home') }}">
        <img src="{{ asset('images/california.svg') }}" alt="CALIFORNIA" />
    </a>
</div>
@endsection
