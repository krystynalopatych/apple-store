<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $userId = Auth::id();
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        $product = Product::findOrFail($productId);

        if ($quantity > $product->stock) {
            return redirect()->back()->with('error', 'Not enough in stock');
        }

        $cartItem = CartItem::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        $newQuantity = $cartItem ? $cartItem->quantity + $quantity : $quantity;

        if ($newQuantity > $product->stock) {
            return redirect()->back()->with('error', 'Not enough in stock');
        }

        if ($cartItem) {
            $cartItem->quantity = $newQuantity;
            $cartItem->save();
        } else {
            CartItem::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function index()
    {
        $cartItems = CartItem::with('product')
            ->where('user_id', Auth::id())
            ->get();

        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        return view('cart.index', compact('cartItems', 'total'));
    }

    public function remove($productId)
    {
        CartItem::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->delete();

        return redirect()->back()->with('success', 'Product removed from cart!');
    }
}
