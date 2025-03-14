<?php

namespace App\Http\Controllers;

use Stripe\Charge;
use Stripe\Stripe;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{    /**
    * Display the dashboard for customers and admins.
    *
    * If the authenticated user is a customer, this function retrieves their orders
    * and returns the user dashboard view. If the user is an admin, it retrieves all orders,
    * products, categories, and users, then returns the admin dashboard view.
    *
    * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
    *         Returns the appropriate dashboard view based on user role,
    *         or redirects to the login page if not authenticated.
    */
   public function index()
   {
       if (Auth::check() && Auth::user()->role === "customer") {
           $user_id = Auth::id();
           $orders = Order::where('user_id', $user_id)->get();
           return view('userDashbord', compact('orders'));
       }

       if (Auth::check() && Auth::user()->role === "admin") {
           $orders = Order::get();
           $products = Product::with('photos')->get();
           $categories = Category::all();
           $users = User::all();
           return view('dashbord', compact('orders', 'products', 'categories', 'users'));
       }

       return redirect()->route('login')->with('error', 'You need to log in first.');
   }

   /**
    * Display the checkout page for the authenticated user.
    *
    * This function retrieves the cart items for the logged-in user
    * and returns the checkout page view.
    *
    * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
    *         Returns the checkout view if the user is logged in,
    *         otherwise redirects to the login page.
    */
   public function checkOut()
   {
       if (Auth::check()) {
           $user_id = Auth::id();
           $cart = Cart::where('user_id', $user_id)->first();

           $cart_items = $cart->cartItems()->with('product')->get();
           return view('checkOut', compact('cart_items'));
       }

       return redirect()->route('login')->with('error', 'You need to log in first.');
   }

   /**
    * Process the order placement and payment.
    *
    * This function calculates the total amount of the cart, processes the payment using Stripe,
    * creates an order, saves order items, and clears the user's cart upon successful payment.
    *
    * @param Request $request The request containing payment and shipping details.
    * @return JsonResponse|\Illuminate\Http\RedirectResponse
    *         Returns a JSON response with order details on success,
    *         or redirects back with an error message if the process fails.
    */
   public function placeOrder(Request $request)
   {
       $user = Auth::user();
       $cartItems = $user->cart->cartItems;
       $totalAmount = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
       Stripe::setApiKey('sk_test_51ONXM0DCnvSZulvv1v6Sp2LH8mPYzbgkE1sV3ECayqErl3s9pvJvDXGQzZP2tcX1zwhAb1HAmtrI2YLuneio2J6R004uiEGOSU');

       try {
           DB::beginTransaction();

           // Process the payment
           Charge::create([
               'amount' => intval($totalAmount * 100),
               'currency' => 'usd',
               'source' => $request->stripe_payment_id,
               'description' => "payment",
           ]);

           // Create the order
           $order = Order::create([
               'user_id' => $user->id,
               'shipping_address' => $request->shipping_address,
               'postal_code' => $request->postal_code,
               'total_price' => $totalAmount,
               'order_number' => strtoupper(uniqid('ORDER_')),
               'payment_status' => 'paid',
               'phone' => $request->phone
           ]);

           // Save order items and clear the cart
           DB::transaction(function () use ($cartItems, $order) {
               foreach ($cartItems as $cartItem) {
                   OrderItem::create([
                       'order_id' => $order->id,
                       'product_id' => $cartItem->product_id,
                       'quantity' => $cartItem->quantity,
                       'price' => $cartItem->product->price,
                   ]);
                   $cartItem->delete();
               }
           });

           DB::commit();
           return response()->json(['success' => true , 'order' => $order])->header('Content-Type', 'application/json');

       } catch (\Exception $e) {
           DB::rollBack();
           return back()->with('error', 'Error: ' . $e->getMessage());
       }
   }
}
