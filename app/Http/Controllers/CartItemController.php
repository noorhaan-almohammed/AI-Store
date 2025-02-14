<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class CartItemController extends Controller
{
        /**
     * Update the quantity of a cart item.
     *
     * This function updates the quantity of a specific cart item
     * based on the action provided in the request. The quantity
     * can be increased or decreased (with a minimum limit of 1).
     *
     * @param Request $request The request containing 'cart_item_id' and 'action' ('increase' or 'decrease').
     * @return JsonResponse Returns a JSON response with success status and updated quantity.
     */
    public function updateQuantity(Request $request)
    {
        $cartItem = CartItem::find($request->cart_item_id);

        if ($cartItem) {
            if ($request->action === 'increase') {
                $cartItem->quantity += 1;
            } elseif ($request->action === 'decrease' && $cartItem->quantity > 1) {
                $cartItem->quantity -= 1;
            }

            $cartItem->save();

            return response()->json(['success' => true, 'quantity' => $cartItem->quantity]);
        }

        return response()->json(['success' => false], 400);
    }

    /**
     * Remove an item from the cart.
     *
     * This function deletes a specific cart item from the database.
     *
     * @param Request $request The request containing 'cart_item_id'.
     * @return JsonResponse Returns a JSON response with success status.
     */
    public function removeFromCart(Request $request)
    {
        $cartItem = CartItem::find($request->cart_item_id);

        if ($cartItem) {
            $cartItem->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 400);
    }

    /**
     * Display the cart page with all cart items.
     *
     * This function retrieves the cart and its associated items
     * for the authenticated user and returns the cart view.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse Returns the cart view if the user is logged in,
     *                                                                otherwise redirects to the login page.
     */
    public function index()
    {
        if (Auth::check()) {
            $user_id = Auth::id();
            $cart = Cart::where('user_id', $user_id)->first();

            $cart_items = $cart->cartItems()->with('product')->get();
            return view('cart', compact('cart_items'));
        }

        return redirect()->route('login')->with('error', 'You need to log in first.');
    }

}
