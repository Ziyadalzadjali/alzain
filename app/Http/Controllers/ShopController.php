<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $categories = ProductCategory::active()->get();

        $query = Product::active()->with('category');

        if ($slug = $request->query('category')) {
            $category = $categories->firstWhere('slug', $slug);
            if ($category) {
                $query->where('product_category_id', $category->id);
            }
        }

        if ($search = $request->query('q')) {
            $query->where('name', 'like', "%{$search}%");
        }

        match ($request->query('sort')) {
            'price_asc' => $query->reorder('price', 'asc'),
            'price_desc' => $query->reorder('price', 'desc'),
            'newest' => $query->reorder('created_at', 'desc'),
            default => null,
        };

        $products = $query->paginate(12)->withQueryString();

        return view('shop.index', [
            'categories' => $categories,
            'products' => $products,
            'activeCategory' => $request->query('category'),
            'sort' => $request->query('sort'),
            'search' => $search,
        ]);
    }

    public function show(Product $product)
    {
        abort_unless($product->is_active, 404);
        $product->load('category');

        $related = Product::active()
            ->where('product_category_id', $product->product_category_id)
            ->where('id', '!=', $product->id)
            ->take(4)->get();

        return view('shop.show', compact('product', 'related'));
    }
}
