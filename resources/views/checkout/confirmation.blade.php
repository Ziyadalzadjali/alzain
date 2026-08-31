@extends('layouts.app')
@section('title', __('Order Confirmed') . ' — Al Zain')

@section('content')
<div class="container-x py-16 max-w-xl text-center">
    <div class="mx-auto w-16 h-16 rounded-full bg-blush-100 flex items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-plum-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
        </svg>
    </div>
    <h1 class="mt-6 text-3xl md:text-4xl">{{ __('Thank you for your order') }}</h1>
    <p class="mt-3 text-plum-700/80">{{ __('Order number') }}: <span class="font-semibold" dir="ltr">{{ $order->order_number }}</span></p>

    <div class="mt-8 card p-6 text-start space-y-2 text-sm">
        @foreach($order->items as $item)
            <div class="flex justify-between">
                <span class="text-plum-700/80">{{ $item->quantity }} &times; {{ $item->name }}</span>
                <span>{{ omr($item->line_total) }}</span>
            </div>
        @endforeach
        <div class="border-t border-blush-100 pt-2 flex justify-between"><span class="text-plum-700/60">{{ __('Subtotal') }}</span><span>{{ omr($order->subtotal) }}</span></div>
        <div class="flex justify-between"><span class="text-plum-700/60">{{ __('Shipping') }}</span><span>{{ $order->shipping > 0 ? omr($order->shipping) : __('Free') }}</span></div>
        <div class="flex justify-between font-semibold text-plum-700 border-t border-blush-100 pt-2"><span>{{ __('Total') }}</span><span>{{ omr($order->total) }}</span></div>
    </div>

    <p class="mt-6 text-sm text-plum-700/70">{{ __('We have received your order and will contact you to arrange :method.', ['method' => $order->delivery_method === 'pickup' ? __('branch pickup') : __('delivery')]) }}</p>

    <a href="{{ route('shop.index') }}" class="btn btn-primary mt-8">{{ __('Continue Shopping') }}</a>
</div>
@endsection
