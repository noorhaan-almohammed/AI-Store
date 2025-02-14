<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
     /**
     * Add a product to the user's cart.
     *
     * This function validates the request to ensure the product exists,
     * checks if the user is authenticated, and then adds the product
     * to the user's cart if it's not already present.
     *
     * @param Request $request The incoming request containing 'product_id'.
     * @return JsonResponse Returns a success message if the product is added,
     *                      a redirect response if the user is not logged in,
     *                      or a message if the product is already in the cart.
     */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        if (!Auth::check()) {
            return response()->json(['redirect' => route('login')]);
        }

        $user_id = Auth::user()->id;
        $user = User::findOrFail($user_id);
        $cart = $user->cart()->firstOrCreate([]);

        // Check if the product is already in the cart
        $existingItem = $cart->cartItems()->where('product_id', $request->product_id)->first();
        if ($existingItem) {
            return response()->json(['message' => 'Product is already in the cart.']);
        }

        // Add the product to the cart
        $cartItem = $cart->cartItems()->create([
            'product_id' => $request->product_id,
            'quantity' => 1,
        ]);

        return response()->json([
            'success' => 'Product added to cart',
            'cartItem' => $cartItem,
        ]);
    }

    /**
     * Retrieve similar products for the authenticated user.
     *
     * This function calls a Python script to get recommended product IDs based
     * on user behavior. It then fetches full product details from the database.
     *
     * @return JsonResponse Returns a JSON response containing an array of similar products.
     */
    public function get_similar_products()
    {
        $userId = Auth::id();

        // Call Python script to retrieve similar products
        $output = shell_exec("python " . escapeshellarg(storage_path('app/python/recommendation.py')) . " " . escapeshellarg($userId));
        file_put_contents(storage_path('app/debug_output.txt'), $output); // Save output for debugging

        $similarProductIds = json_decode($output, true);

        // Check if valid data is retrieved
        if (empty($similarProductIds)) {
            return response()->json([]);
        }

        // Fetch full product details from the database
        $similarProducts = Product::whereIn('id', collect($similarProductIds)->pluck('id'))->with('photos')->get();

        return response()->json($similarProducts);
    }

}
