@component('mail::message')
# Thank you for your order!

Order ID: {{ $order->id }}

**Status:** {{ $order->status }}

**Total Price:** ${{ number_format($order->total_price, 2) }}

## Items ordered:

@foreach ($order->orderItems as $item)
- {{ $item->product->name }}  
  Quantity: {{ $item->quantity }}  
  Price: ${{ number_format($item->price, 2) }}
@endforeach

Thanks for shopping with us!

Regards,  
California
@endcomponent

