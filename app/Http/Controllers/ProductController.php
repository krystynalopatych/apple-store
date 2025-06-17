<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // View list of products (public part)
    public function index(Request $request)
    {
        $query = Product::query();
        $categories = Category::all();

        // Фильтр по категории — только если выбрана конкретная категория
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Фильтр по имени — если есть поиск
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->paginate(12);

        return view('products.index', compact('products', 'categories'));
    }


    // View a specific product
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function home()
    {
        $products = Product::latest()->take(4)->get();
        return view('index', compact('products'));
    }

}

