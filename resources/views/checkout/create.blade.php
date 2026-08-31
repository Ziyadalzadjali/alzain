@extends('layouts.app')
@section('title', __('Checkout') . ' — Al Zain')

@section('content')
<div class="container-x py-12">
    <h1 class="text-3xl md:text-4xl mb-8">{{ __('Checkout') }}</h1>

    <form method="POST" action="{{ route('checkout.store') }}" class="grid lg:grid-cols-[1fr_340px] gap-10">
        @csrf
        <div class="space-y-8">
            <section class="card p-6">
                <h2 class="text-lg mb-4">{{ __('Contact details') }}</h2>
                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label class="label" for="customer_name">{{ __('Full name') }}</label>
                        <input type="text" name="customer_name" id="customer_name" class="field" required value="{{ old('customer_name') }}">
                    </div>
                    <div>
                        <label class="label" for="customer_phone">{{ __('Phone') }}</label>
                        <input type="tel" name="customer_phone" id="customer_phone" class="field" dir="ltr" required value="{{ old('customer_phone') }}">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="label" for="customer_email">{{ __('Email') }} <span class="text-plum-700/50 font-normal">({{ __('optional') }})</span></label>
                        <input type="email" name="customer_email" id="customer_email" class="field" dir="ltr" value="{{ old('customer_email') }}">
                    </div>
                </div>
            </section>

            <section class="card p-6">
                <h2 class="text-lg mb-4">{{ __('Delivery') }}</h2>
                <div class="flex gap-3 mb-4">
                    <label class="flex-1 border border-blush-200 rounded-xl p-3 text-sm cursor-pointer has-[:checked]:border-rose-400 has-[:checked]:bg-blush-100/60">
                        <input type="radio" name="delivery_method" value="delivery" class="me-2" @checked(old('delivery_method', 'delivery') === 'delivery')>
                        {{ __('Home delivery') }}
                    </label>
                    <label class="flex-1 border border-blush-200 rounded-xl p-3 text-sm cursor-pointer has-[:checked]:border-rose-400 has-[:checked]:bg-blush-100/60">
                        <input type="radio" name="delivery_method" value="pickup" class="me-2" @checked(old('delivery_method') === 'pickup')>
                        {{ __('Pick up at branch') }}
                    </label>
                </div>
                <div class="grid sm:grid-cols-2 gap-4">
                    <div class="sm:col-span-2">
                        <label class="label" for="address_line">{{ __('Address') }}</label>
                        <input type="text" name="address_line" id="address_line" class="field" value="{{ old('address_line') }}">
                    </div>
                    <div>
                        <label class="label" for="city">{{ __('City') }}</label>
                        <input type="text" name="city" id="city" class="field" value="{{ old('city', 'Muscat') }}">
                    </div>
                </div>
            </section>

            <section class="card p-6">
                <h2 class="text-lg mb-4">{{ __('Payment') }}</h2>
                <div class="space-y-2 text-sm">
                    <label class="flex items-center gap-2 border border-blush-200 rounded-xl p-3 cursor-pointer has-[:checked]:border-rose-400">
                        <input type="radio" name="payment_method" value="cod" @checked(old('payment_method', 'cod') === 'cod')>
                        {{ __('Cash on delivery / at branch') }}
                    </label>
                    <label class="flex items-center gap-2 border border-blush-200 rounded-xl p-3 cursor-pointer has-[:checked]:border-rose-400 opacity-60">
                        <input type="radio" name="payment_method" value="card" @checked(old('payment_method') === 'card')>
                        {{ __('Card (Thawani) — coming soon') }}
                    </label>
                </div>
                <div class="mt-4">
                    <label class="label" for="notes">{{ __('Order notes') }} <span class="text-plum-700/50 font-normal">({{ __('optional') }})</span></label>
                    <textarea name="notes" id="notes" rows="2" class="field">{{ old('notes') }}</textarea>
                </div>
            </section>
        </div>

        <aside class="card p-6 h-fit space-y-3 text-sm">
            <h2 class="text-lg mb-2">{{ __('Your order') }}</h2>
            @foreach($items as $item)
                <div class="flex justify-between gap-2">
                    <span class="text-plum-700/80 line-clamp-1">{{ $item['quantity'] }} &times; {{ $item['product']->name }}</span>
                    <span class="shrink-0">{{ omr($item['line_total']) }}</span>
                </div>
            @endforeach
            <div class="border-t border-blush-100 pt-3 flex justify-between"><span class="text-plum-700/60">{{ __('Subtotal') }}</span><span>{{ omr($cart->subtotal()) }}</span></div>
            <div class="flex justify-between"><span class="text-plum-700/60">{{ __('Shipping') }}</span><span>{{ $cart->shipping() > 0 ? omr($cart->shipping()) : __('Free') }}</span></div>
            <div class="flex justify-between text-base font-semibold text-plum-700 border-t border-blush-100 pt-3"><span>{{ __('Total') }}</span><span>{{ omr($cart->total()) }}</span></div>
            <button type="submit" class="btn btn-primary w-full mt-3">{{ __('Place Order') }}</button>
        </aside>
    </form>
</div>
@endsection
