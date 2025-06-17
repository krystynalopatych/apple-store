@extends('layouts.app')

@section('content')
<div class="order-success-container">
    <div class="order-success-card">
        <h2 class="order-success-title">Thanks for your order!</h2>
        <p class="order-success-info">
            Your order <span class="order-id">#{{ $order->id }}</span> has been successfully 
            <span class="order-status">paid</span>.
        </p>
        <p class="order-success-email">We have sent a confirmation to your email.</p>

        <a href="{{ route('home') }}" class="order-success-button">Return to Home</a>

        <div class="order-success-logo">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/california.svg') }}" alt="CALIFORNIA" />
            </a>
        </div>
    </div>
</div>
@endsection

