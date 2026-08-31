<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Support\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function create(Cart $cart)
    {
        if ($cart->isEmpty()) {
            return redirect()->route('shop.index')->with('status', __('Your bag is empty.'));
        }

        return view('checkout.create', ['items' => $cart->items()]);
    }

    public function store(Request $request, Cart $cart)
    {
        if ($cart->isEmpty()) {
            return redirect()->route('shop.index');
        }

        $data = $request->validate([
            'customer_name' => ['required', 'string', 'max:120'],
            'customer_phone' => ['required', 'string', 'max:40'],
            'customer_email' => ['nullable', 'email', 'max:160'],
            'delivery_method' => ['required', 'in:delivery,pickup'],
            'address_line' => ['required_if:delivery_method,delivery', 'nullable', 'string', 'max:255'],
            'city' => ['required_if:delivery_method,delivery', 'nullable', 'string', 'max:120'],
            'payment_method' => ['required', 'in:cod,card'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $order = DB::transaction(function () use ($data, $cart) {
            $order = Order::create([
                'customer_name' => $data['customer_name'],
                'customer_phone' => $data['customer_phone'],
                'customer_email' => $data['customer_email'] ?? null,
                'delivery_method' => $data['delivery_method'],
                'shipping_address' => $data['delivery_method'] === 'delivery' ? [
                    'address_line' => $data['address_line'],
                    'city' => $data['city'],
                ] : null,
                'subtotal' => $cart->subtotal(),
                'shipping' => $cart->shipping(),
                'total' => $cart->total(),
                'payment_method' => $data['payment_method'],
                'status' => 'pending',
                'notes' => $data['notes'] ?? null,
            ]);

            foreach ($cart->items() as $item) {
                $order->items()->create([
                    'product_id' => $item['product']->id,
                    'name' => $item['product']->getTranslation('name', app()->getLocale()),
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'line_total' => $item['line_total'],
                ]);
                // Stock is reserved on order; deduct now for the skeleton.
                $item['product']->decrement('stock', min($item['quantity'], $item['product']->stock));
            }

            return $order;
        });

        $cart->clear();

        return redirect()->route('checkout.confirmation', $order->order_number);
    }

    public function confirmation(string $orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)->with('items')->firstOrFail();

        return view('checkout.confirmation', compact('order'));
    }
}
