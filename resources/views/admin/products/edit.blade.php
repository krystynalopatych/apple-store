@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data" class="product-form">
        <h1 class="product-form__title">Edit Product</h1>

        @csrf
        @method('PUT')

        <div class="product-form__group">
            <label for="name" class="product-form__label">Product Name</label>
            <input type="text" id="name" name="name" class="product-form__input" value="{{ old('name', $product->name) }}" required>
        </div>

        <div class="product-form__group">
            <label for="description" class="product-form__label">Description</label>
            <textarea id="description" name="description" class="product-form__textarea" required>{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="product-form__group">
            <label for="price" class="product-form__label">Price</label>
            <input type="number" step="0.01" id="price" name="price" class="product-form__input" value="{{ old('price', $product->price) }}" required>
        </div>

        <div class="product-form__group">
            <label for="stock" class="product-form__label">Stock</label>
            <input type="number" id="stock" name="stock" class="product-form__input" value="{{ old('stock', $product->stock) }}" required>
        </div>

        <div class="product-form__group">
            <label for="category_id" class="product-form__label">Category</label>
            <select id="category_id" name="category_id" class="product-form__select" required>
                <option value="">-- Select category --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ (old('category_id', $product->category_id) == $category->id) ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="product-form__group">
            <label for="image" class="product-form__label">Image URL</label>
            <input type="text" id="image" name="image" class="product-form__input" value="{{ old('image', $product->image) }}" required>
        </div>

        <button type="submit" class="product-form__button">Update Product</button>
    </form>
@endsection
