<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();

        $categories = Category::all();

        return Inertia::render('Product/Product', [
            'products' => $products,
            'categories' => $categories
        ]);
    }
}
