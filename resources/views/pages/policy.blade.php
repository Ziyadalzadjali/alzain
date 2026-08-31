@extends('layouts.app')
@php
    $titles = [
        'privacy' => __('Privacy Policy'),
        'terms' => __('Terms & Conditions'),
        'shipping-returns' => __('Shipping & Returns'),
    ];
    $title = $titles[$page];
@endphp
@section('title', $title . ' — Al Zain')

@section('content')
<div class="container-x py-16 max-w-2xl">
    <h1 class="text-3xl md:text-4xl">{{ $title }}</h1>
    <div class="mt-6 space-y-4 text-sm text-plum-700/85 leading-relaxed">
        @if($page === 'shipping-returns')
            <p>{{ __('We deliver across Oman. Orders are dispatched within 1–2 business days. Delivery is free on orders over :amount; a flat fee of :fee applies below that.', ['amount' => omr(\App\Support\Cart::FREE_SHIPPING_FROM), 'fee' => omr(\App\Support\Cart::FLAT_SHIPPING)]) }}</p>
            <p>{{ __('Unopened products may be returned within 7 days for an exchange or store credit. For hygiene reasons, opened skincare cannot be returned unless faulty.') }}</p>
        @elseif($page === 'privacy')
            <p>{{ __('We collect only the details needed to fulfil your bookings and orders — your name, contact number, email and delivery address. We never sell your data.') }}</p>
            <p>{{ __('You can ask us to update or delete your information at any time by contacting the salon.') }}</p>
        @else
            <p>{{ __('By booking an appointment or placing an order with Al Zain you agree to these terms. Appointments should be cancelled at least 4 hours in advance. Prices are in Omani Rial and include tax where applicable.') }}</p>
            <p>{{ __('This is placeholder policy text for the launch skeleton — replace it with your finalised wording before going live.') }}</p>
        @endif
    </div>
</div>
@endsection
