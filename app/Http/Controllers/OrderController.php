<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Mail\OrderUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::orderBy('created_at', 'desc');
        
        if ($request->has('hide_archived') && $request->hide_archived) {
            $query->where('status', '!=', 'archived');
        }
        
        $orders = $query->paginate(25);
        
        return view('orderadmin', compact('orders'));
    }
    
    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'customer_name' => 'sometimes|required|string|max:255',
            'customer_email' => 'sometimes|required|email|max:255',
            'payment_method' => 'sometimes|required|in:credit_card,paypal,bank_transfer,cash_on_delivery',
            'status' => 'sometimes|required|in:pending,processing,shipped,completed,archived',
        ]);
        
        $order->update($validated);
        
        return back()->with('success', 'Order updated successfully');
    }
    
    public function sendPickupDate(Request $request, Order $order)
    {
        $request->validate(['pickup_date' => 'required|date']);
        
        $order->update(['status' => 'pickup']);

        Mail::to($order->customer_email)->send(
            new OrderUpdate($order, [
                'type' => 'pickup',
                'date' => $request->pickup_date
            ])
        );
        
        return back()->with('success', 'Pickup date notification sent');
    }
    
    public function sendTrackingNumber(Request $request, Order $order)
    {
        $request->validate(['tracking_number' => 'required|string|max:255']);
        
        //Not neccesary for my usecase $order->update(['tracking_number' => $request->tracking_number]);
        
        $order->update(['status' => 'shipped']);

        Mail::to($order->customer_email)->send(
            new OrderUpdate($order, [
                'type' => 'tracking',
                'tracking_number' => $request->tracking_number
            ])
        );
        
        return back()->with('success', 'Tracking number notification sent');
    }
    
    public function archive(Order $order)
    {
        $order->update(['status' => 'archived']);
        return back()->with('success', 'Order archived');
    }
}
