@extends('layouts.app')

@section('content')
<h1>Product List (Admin)</h1>

<a href="{{ route('admin.products.create') }}" class="btn-primary">
        Add New Product
</a>

<form method="GET" action="{{ route('admin.products.index') }}" class="products-filter-form">
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

            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn blue">Update</a>

            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure?');" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn green">Delete</button>
            </form>
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

