<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Order Receipt</title>
</head>
<body>
    <h1>Order Receipt</h1>

    <p><strong>Customer:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Order ID:</strong> #{{ $order->id }}</p>
    <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
    @foreach ($order->orderItems as $item)
        <p><strong>Product Name -</strong> {{ $item->product->name }}</p>
        <p><strong>Quantity:</strong> {{ $item->quantity }}</p>
    @endforeach
    <div>
        <p><strong>Total Amount:</strong> ${{ number_format($order->total_price, 2) }}</p>
    </div>
</body>
</html>
