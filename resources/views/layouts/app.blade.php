<!DOCTYPE html>
<html>
<head>
    <title>My Shop</title>
    <link rel="stylesheet" href="{{ asset('styles/products.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/cart.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/order.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/success.css') }}">
</head>
<body>
    <div class="container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

        @yield('content')
    </div>
</body>
</html>
