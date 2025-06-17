@extends('layouts.app')

@section('content')
<h1>Product List</h1>

<form method="GET" action="{{ route('products.index') }}" class="products-filter-form">
    <select name="category">
        <option value="">All Categories</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ request()->input('category') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}">

    <button type="submit">Filter</button>
</form>

<div class="products-container">
    @foreach ($products as $product)
        <div class="product-card">
            <img src="{{ $product->image }}" alt="{{ $product->name }}">
            <h3>{{ $product->name }}</h3>
            <p class="description">{{ Str::limit($product->description, 80) }}</p>
            <p class="price">${{ number_format($product->price, 2) }}</p>
            <p class="stock">Stock: {{ $product->stock }}</p>

            @auth
                @if (Auth::user()->role == 'user')
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit" class="btn blue">Add to cart</button>
                    </form>
                @endif
            @else
                <a href="{{ route('login') }}" onclick="alert('Please login to add to cart')" class="btn blue">Add to cart</a>
            @endauth
        </div>
    @endforeach
</div>
<div class="logo">
        <a href="{{ route('home') }}">
            <img src="{{ asset('images/california.svg') }}" alt="CALIFORNIA" />
        </a>
</div>
<div class="pagination-wrapper">
    {{ $products->withQueryString()->links() }}
</div>
@endsection
