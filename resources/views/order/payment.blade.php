@extends('layouts.app')

@section('content')
<div class="payment-container">
  <h2 class="payment-title">Payment for the order #{{ $order->id }}</h2>
  <p class="payment-amount">Amount: ${{ number_format($order->total_price, 2) }}</p>

  <form action="{{ route('order.payment.process', $order) }}" method="POST" class="payment-form">
    @csrf
    <div class="payment-field">
      <label for="card_number" class="payment-label">Card Number:</label><br>
      <input type="text" name="card_number" id="card_number" maxlength="16" required class="payment-input">
    </div>
    <div class="payment-field">
      <label for="expiry_month" class="payment-label">Expiry Month(EM):</label><br>
      <input type="text" name="expiry_month" id="expiry_month" maxlength="2" required class="payment-input">
    </div>
    <div class="payment-field">
      <label for="expiry_year" class="payment-label">Expiry Year(EY):</label><br>
      <input type="text" name="expiry_year" id="expiry_year" maxlength="2" required class="payment-input">
    </div>
    <div class="payment-field">
      <label for="cvc" class="payment-label">CVC:</label><br>
      <input type="text" name="cvc" id="cvc" maxlength="3" required class="payment-input">
    </div>
    <button type="submit" class="payment-btn">Pay</button>
  </form>
</div>
<div class="logo">
    <a href="{{ route('home') }}">
        <img src="{{ asset('images/california.svg') }}" alt="CALIFORNIA" />
    </a>
</div>
@endsection