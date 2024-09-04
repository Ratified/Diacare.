<?php

namespace App\Http\Controllers\Cart;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        
        $cartItems = Cart::where('user_id', $userId)->get();

        return view('cart.index', ['cartItems' => $cartItems]);
    }

    public function store(Request $request){
        if(!auth()->check()){
            return redirect()->route('login')->with('message', 'You need to login to add items to cart');
        } 

        $productId = $request->input('product_id');
        $userId = auth()->id(); 

        // Check if item already exists in cart for the user
        $cartItem = Cart::where('user_id', $userId)
                        ->where('product_id', $productId)
                        ->first();

        if ($cartItem) {
            // If item exists, increment quantity
            $cartItem->increment('quantity');
        } else {
            // Otherwise, create a new cart item
            $cartItem = new Cart();
            $cartItem->user_id = $userId;
            $cartItem->product_id = $productId;
            $cartItem->quantity = 1; 
            $cartItem->save();
        }

        return redirect()->back()->with('message', 'Item added to cart successfully');
    }
}
