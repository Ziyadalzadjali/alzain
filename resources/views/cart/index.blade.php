@extends('layouts.app')
@section('title', __('Your Bag') . ' — Al Zain')

@section('content')
<div class="container-x py-12">
    <h1 class="text-3xl md:text-4xl mb-8">{{ __('Your Bag') }}</h1>

    @if($items->isEmpty())
        <div class="card p-12 text-center">
            <p class="text-plum-700/70">{{ __('Your bag is empty.') }}</p>
            <a href="{{ route('shop.index') }}" class="btn btn-primary mt-5">{{ __('Start Shopping') }}</a>
        </div>
    @else
        <div class="grid lg:grid-cols-[1fr_320px] gap-10">
            <div class="space-y-4">
                @foreach($items as $item)
                    <div class="card p-4 flex gap-4 items-center">
                        <a href="{{ route('shop.show', $item['product']) }}" class="shrink-0">
                            @if($item['product']->main_image)
                                <img src="{{ $item['product']->main_image }}" alt="" class="w-20 h-20 rounded-lg object-cover">
                            @else
                                <x-placeholder :label="$item['product']->name" :seed="$item['product']->id" class="w-20 h-20 rounded-lg" />
                            @endif
                        </a>
                        <div class="flex-1 min-w-0">
                            <a href="{{ route('shop.show', $item['product']) }}" class="font-medium text-plum-900 hover:text-rose-500 line-clamp-1">{{ $item['product']->name }}</a>
                            <p class="text-sm text-plum-700/60">{{ omr($item['price']) }}</p>
                            <form method="POST" action="{{ route('cart.update') }}" class="mt-2 flex items-center gap-2">
                                @csrf @method('PATCH')
                                <input type="hidden" name="product_id" value="{{ $item['product']->id }}">
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="0" max="99" class="field w-16 !py-1 text-sm">
                                <button class="text-xs font-semibold text-rose-500 hover:underline">{{ __('Update') }}</button>
                            </form>
                        </div>
                        <div class="text-end">
                            <p class="font-semibold text-plum-700">{{ omr($item['line_total']) }}</p>
                            <form method="POST" action="{{ route('cart.remove') }}">
                                @csrf @method('DELETE')
                                <input type="hidden" name="product_id" value="{{ $item['product']->id }}">
                                <button class="text-xs text-plum-700/50 hover:text-rose-500 mt-2">{{ __('Remove') }}</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <aside class="card p-6 h-fit space-y-3 text-sm">
                <h2 class="text-lg mb-2">{{ __('Order Summary') }}</h2>
                <div class="flex justify-between"><span class="text-plum-700/60">{{ __('Subtotal') }}</span><span>{{ omr($cart->subtotal()) }}</span></div>
                <div class="flex justify-between"><span class="text-plum-700/60">{{ __('Shipping') }}</span><span>{{ $cart->shipping() > 0 ? omr($cart->shipping()) : __('Free') }}</span></div>
                <div class="flex justify-between border-t border-blush-100 pt-3 text-base font-semibold text-plum-700"><span>{{ __('Total') }}</span><span>{{ omr($cart->total()) }}</span></div>
                <a href="{{ route('checkout.create') }}" class="btn btn-primary w-full mt-3">{{ __('Checkout') }}</a>
                <a href="{{ route('shop.index') }}" class="block text-center text-xs text-plum-700/60 hover:underline">{{ __('Continue shopping') }}</a>
            </aside>
        </div>
    @endif
</div>
@endsection
