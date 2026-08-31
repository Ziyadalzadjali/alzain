<?php

namespace App\Support;

use App\Models\Product;
use Illuminate\Support\Collection;

class Cart
{
    protected const KEY = 'cart';

    /** Free-shipping threshold in OMR. */
    public const FREE_SHIPPING_FROM = 20.0;

    public const FLAT_SHIPPING = 2.0;

    public function items(): Collection
    {
        $raw = session(self::KEY, []);
        $products = Product::whereIn('id', array_keys($raw))->get()->keyBy('id');

        return collect($raw)
            ->map(function ($qty, $id) use ($products) {
                $product = $products->get($id);
                if (! $product) {
                    return null;
                }
                $price = $product->current_price;

                return [
                    'product' => $product,
                    'quantity' => (int) $qty,
                    'price' => $price,
                    'line_total' => round($price * $qty, 3),
                ];
            })
            ->filter()
            ->values();
    }

    public function add(int $productId, int $qty = 1): void
    {
        $raw = session(self::KEY, []);
        $raw[$productId] = ($raw[$productId] ?? 0) + $qty;
        session([self::KEY => $raw]);
    }

    public function update(int $productId, int $qty): void
    {
        $raw = session(self::KEY, []);
        if ($qty <= 0) {
            unset($raw[$productId]);
        } else {
            $raw[$productId] = $qty;
        }
        session([self::KEY => $raw]);
    }

    public function remove(int $productId): void
    {
        $raw = session(self::KEY, []);
        unset($raw[$productId]);
        session([self::KEY => $raw]);
    }

    public function clear(): void
    {
        session()->forget(self::KEY);
    }

    public function count(): int
    {
        return array_sum(session(self::KEY, []));
    }

    public function subtotal(): float
    {
        return round($this->items()->sum('line_total'), 3);
    }

    public function shipping(): float
    {
        $sub = $this->subtotal();
        if ($sub <= 0 || $sub >= self::FREE_SHIPPING_FROM) {
            return 0.0;
        }

        return self::FLAT_SHIPPING;
    }

    public function total(): float
    {
        return round($this->subtotal() + $this->shipping(), 3);
    }

    public function isEmpty(): bool
    {
        return $this->count() === 0;
    }
}
