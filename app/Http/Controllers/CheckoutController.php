<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmation;

class CheckoutController extends Controller
{
    public function show()
    {
        // Gets cart items from session
        $cartItems = session('cart', []);
        if (empty($cartItems)) {
            return redirect('/store')->with('error', 'Your cart is empty');
        }
        //Returns items and a grand total
        return view('store.checkout', [
            'cartItems' => $cartItems,
            'total' => $this->calculateTotal($cartItems)
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string',
            'billing_address' => 'nullable|string',
            'payment_method' => 'required|in:credit_card,paypal,bank_transfer,cash_on_delivery',
            'notes' => 'nullable|string'
        ]);

        $cartItems = session('cart', []);
        if (empty($cartItems)) {
            return back()->with('error', 'Your cart is empty');
        }

        $order = Order::create([
            'user_id' => auth()->id(),
            'cart_items' => $this->getCartDetails($cartItems),
            'total_amount' => $this->calculateTotal($cartItems),
            'payment_method' => $validated['payment_method'],
            'customer_name' => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
            'customer_phone' => $validated['customer_phone'],
            'shipping_address' => $validated['shipping_address'],
            'billing_address' => $validated['billing_address'] ?? $validated['shipping_address'],
            'notes' => $validated['notes'] ?? null,
            'status' => 'pending'
        ]);

        try {
            Mail::to($order->customer_email)->send(new OrderConfirmation($order));
        } catch (\Exception $e) {
            \Log::error('Email sending failed: ' . $e->getMessage());
            // Continue with the order even if email fails
        }
        
        session()->forget('cart');
        
        return redirect()->route('order.confirmation', $order->order_number)
                         ->with('success', 'Rendelés sikeresen leadva!');
    }

    protected function calculateTotal($cartItems)
    {
        $total = 0;
        foreach ($cartItems as $itemId => $quantity) {
            $item = \App\Models\Store::find($itemId);
            if ($item) {
                $total += $item->price * $quantity;
            }
        }
        return $total;
    }

    protected function getCartDetails($cartItems)
    {
        $details = [];
        foreach ($cartItems as $itemId => $quantity) {
            $item = \App\Models\Store::find($itemId);
            if ($item) {
                $details[] = [
                    'id' => $item->id,
                    'name' => $item->name,
                    'price' => $item->price,
                    'quantity' => $quantity,
                    'total' => $item->price * $quantity
                ];
            }
        }
        return $details;
    }
}
