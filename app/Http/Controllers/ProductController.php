<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
     /**
     * Display the product listing page with optional category filtering.
     *
     * This function retrieves all categories and products, with an optional filter
     * to display only products belonging to a specific category if provided in the request.
     * If the request is an AJAX request, it returns the products as a JSON response.
     * Otherwise, it returns the main index view with products and categories.
     *
     * @param Request $request The incoming request containing an optional 'category' query parameter.
     * @return \Illuminate\View\View|\Illuminate\Http\JsonResponse
     *         Returns the product listing view with categories,
     *         or a JSON response with products if it's an AJAX request.
     */
    public function index(Request $request)
    {
        $category_id = $request->query('category');
        $categories = Category::all();

        if ($category_id) {
            $products = Product::with('photos')->where('category_id', $category_id)->get();
        } else {
            $products = Product::with('photos')->get();
        }

        if ($request->ajax()) {
            return response()->json($products);
        }

        return view('index', compact('products', 'categories'));
    }

}
