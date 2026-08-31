<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Support\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Cart $cart)
    {
        return view('cart.index', ['items' => $cart->items()]);
    }

    public function add(Request $request, Cart $cart)
    {
        $data = $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['nullable', 'integer', 'min:1', 'max:99'],
        ]);

        $product = Product::findOrFail($data['product_id']);
        abort_unless($product->is_active, 404);

        $cart->add($product->id, $data['quantity'] ?? 1);

        return back()->with('status', __('Added to your bag.'));
    }

    public function update(Request $request, Cart $cart)
    {
        $data = $request->validate([
            'product_id' => ['required', 'integer'],
            'quantity' => ['required', 'integer', 'min:0', 'max:99'],
        ]);

        $cart->update($data['product_id'], $data['quantity']);

        return back()->with('status', __('Bag updated.'));
    }

    public function remove(Request $request, Cart $cart)
    {
        $cart->remove((int) $request->input('product_id'));

        return back()->with('status', __('Item removed.'));
    }
}
