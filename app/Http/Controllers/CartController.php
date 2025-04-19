<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = session()->get('cart', []);
        
        if (empty($cartItems)) {
            return response()->json([]); // Return empty array, not empty object
        }
        
        $cartDetails = [];
        // In the forach loop we need to parse the data we get in cartItems. There is an id and a quantity.
        foreach ($cartItems as $itemId => $quantity) {
            $item = \App\Models\Store::find($itemId);
            // Constructing an array of he info we get from the DB.
            if ($item) {
                $cartDetails[] = [
                    'id' => $item->id,
                    'name' => $item->name,
                    'price' => $item->price,
                    'quantity' => $quantity,
                    'total' => $item->price * $quantity
                ];
            }
        }
        
        return response()->json($cartDetails); // Returns the array of items.
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'item_id' => 'required|integer',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = session()->get('cart', []);

        // Use the validated data
        $itemId = $validated['item_id'];
        $quantity = $validated['quantity'];

        // Pairs up the id and the quantity. Either adds to existing, or makes new entry in array.
        if (isset($cart[$itemId])) {
            $cart[$itemId] += $quantity;
        } else {
            $cart[$itemId] = $quantity;
        }

        //Puts the new cart details into the session.
        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'cart' => $cart
        ]);
    }

    //This whole function is not used at all. But I'm goning to leave it here anyways. I might make it into a feature later.
    public function update(Request $request, $itemId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:0'
        ]);

        $quantity = $request->input('quantity');
        $cart = session()->get('cart', []);

        if ($quantity <= 0) {
            unset($cart[$itemId]);
        } else {
            $cart[$itemId] = $quantity;
        }

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'cart' => $cart
        ]);
    }

    public function remove($itemId)
    {
        $cart = session()->get('cart', []);

        //Unset the specific cart item. 
        if (isset($cart[$itemId])) {
            unset($cart[$itemId]);
            session()->put('cart', $cart);
        }

        return response()->json([
            'success' => true,
            'cart' => $cart
        ]);
    }

    // This clears the whole cart. It's not called however. 
    public function clear()
    {
        session()->forget('cart');
        return response()->json(['success' => true]);
    }
}