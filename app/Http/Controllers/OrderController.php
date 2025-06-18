<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderPlaced;


class OrderController extends Controller
{
    public function checkout(Request $request)
    {

        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        // Get all items from the user's cart
        $cartItems = CartItem::where('user_id', $user->id)->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty!');
        }

        // Calculate the total cost of the order
        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $totalPrice += $item->quantity * $item->product->price;
        }

        // Create an order
        $order = Order::create([
            'user_id' => $user->id,
            'status' => 'pending',
            'total_price' => $totalPrice
        ]);

        // Create OrderItem records for each product in the cart
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price
            ]);
            // Reduce the quantity in stock
            $product = $item->product;
            $product->stock -= $item->quantity;
            $product->save();
        }

        // Clear the user's cart
        CartItem::where('user_id', $user->id)->delete();

        return redirect()->route('order.payment.form', $order);
    }

    public function paymentForm(Order $order)
    {
        return view('order.payment', compact('order'));
    }

    public function processPayment(Request $request, Order $order)
    {
        $user = Auth::user();
        // There should be integration with the payment gateway here !!!!!!!

        $request->validate([
            'card_number' => 'required|digits:16',
            'expiry_month' => 'required|digits:2',
            'expiry_year' => 'required|digits:2',
            'cvc' => 'required|digits:3',
        ]);

        // Here is integration with the payment system !!!!!!!!

        // Update the order status
        $order->update(['status' => 'paid']);

        $order->load('orderItems.product');

        $pdf = Pdf::loadView('emails.orders.receipt', [
            'user' => $user,
            'order' => $order
        ]);

        // Send a notification to the user's email
        Mail::to($user->email)->send(new OrderPlaced($user, $order, $pdf->output()));

        return redirect()->route('order.success', $order);
    }

    public function success(Order $order)
    {
        return view('order.success', compact('order'));
    }
}
